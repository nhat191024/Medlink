<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

use App\Models\User;
use App\Models\Service;
use App\Models\UserSetting;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\UserInsurance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $rules = [
            'login' => 'required|string',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z]{6,})(?=.*\d)(?=.*[&$#%]).+$/',
        ];

        $messages = [
            'login.required' => __('auth.validation.required', ['attribute' => 'login']),
            'password.required' => __('auth.validation.required', ['attribute' => 'password']),
            'password.min' => __('auth.validation.min', ['attribute' => 'password', 'min' => 8]),
            'password.regex' => __('auth.validation.regex', ['attribute' => 'password']),
        ];

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        switch ($loginType) {
            case 'phone':
                $rules['login'] = 'required|string|regex:/^\+[0-9]{1,3}[0-9]{10,15}$/';
                $messages['login.regex'] = __('auth.validation.regex', ['attribute' => 'phone']);
                break;
            case 'email':
            default:
                $rules['login'] = 'required|string|email';
                $messages['login.email'] = __('auth.validation.email', ['attribute' => 'email']);
                break;
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        $login = $loginType == 'email' ? $request->input('login') : substr($request->input('login'), 1);

        $credentials = [
            $loginType => $login,
            'password' => $request->input('password'),
        ];

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

        $userQuery = User::withTrashed()->where($loginType, $login);
        $user = $userQuery->first();

        if (!$user) {
            return response()->json([
                "message" => __('error.errors.not_exists', ['attribute' => $loginType]),
            ], Response::HTTP_NOT_FOUND);
        }

        if (method_exists($user, 'trashed') && $user->trashed()) {
            return response()->json([
                "message" => __('auth.status.suspended'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "message" => __('auth.login.failed'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (Auth::user()->status === 'waiting-approval') {
            return response()->json([
                "message" => __('auth.status.not_approved'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        // Check if user already has tokens, delete them before creating a new one
        if ($user->tokens()->count() > 0) {
            $user->tokens()->delete();
        }
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            "message" => __('auth.login.success'),
            "userType" => $user->user_type,
            "token" => $token,
        ], Response::HTTP_OK);
    }
    public function checkEmail(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => __('auth.validation.required', ['attribute' => 'email']),
            'email.email' => __('auth.validation.email', ['attribute' => 'email']),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

        if (User::where('email', $request->input('email'))->count() == 0) {
            return response()->json([
                "message" => __('error.errors.not_exists', ['attribute' => 'email']),
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            "message" => __('auth.validation.exists', ['attribute' => 'email']),
        ], Response::HTTP_OK);
    }

    public function Register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = new User();
            $user->phone = $request->input('phone');
            $user->country_code = $request->input('countryCode');
            $user->user_type = $request->input('userType');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            $emailFirstLetter = strtolower(substr($user->email, 0, 1));

            if ($request->hasFile('avatar')) {
                $imageName = time() . '_' . uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(storage_path('app/public/upload/avatar/'), $imageName);
                $user->avatar = "/upload/avatar/{$imageName}";
            } else {
                $user->avatar = "https://ui-avatars.com/api/?name=" . urlencode($emailFirstLetter) . "&background=random&size=512";
            }

            switch ($request->input('userType')) {
                case 'healthcare':
                    $user->identity = $request->input('identity');
                    $user->status = 'waiting-approval';
                    $user->save();
                    $this->healthcareCreate($user->id, $request->input('identity'), $request);
                    break;
                case 'patient':
                    $user->name = $request->input('name');
                    $user->address = $request->input('address');
                    $user->save();
                    $this->patientCreate($user->id, $request);
                    break;
                default:
                    return 1;
            }

            $this->createSettings($user->id);

            if ($request->input('userType') == 'patient') {
                $token = $user->createToken('token')->plainTextToken;
                DB::commit();
                return response()->json([
                    "message" => "success",
                    "token" => $token,
                ], Response::HTTP_CREATED);
            }

            DB::commit();
            return response()->json([
                "message" => "success",
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "message" => "Registration failed.",
                "error" => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function healthcareCreate($userId, $identity, RegisterRequest $request)
    {
        $profile = new DoctorProfile();
        $profile->user_id = $userId;
        switch ($identity) {
            case 'doctor':
                if ($request->hasFile('idCard')) {
                    $imageName = time() . '_' . uniqid() . '.' . $request->file('idCard')->getClientOriginalExtension();
                    $request->file('idCard')->move(storage_path('app/public/upload/doctor_assets'), $imageName);
                    $profile->id_card_path = "/upload/doctor_assets/{$imageName}";
                }

                if ($request->hasFile('medicalDegree')) {
                    $imageName = time() . '_' . uniqid() . '.' . $request->file('medicalDegree')->getClientOriginalExtension();
                    $request->file('medicalDegree')->move(storage_path('app/public/upload/doctor_assets'), $imageName);
                    $profile->medical_degree_path = "/upload/doctor_assets/{$imageName}";
                }
                $profile->professional_number = $request->input('professionalNumber');
                break;

            case 'pharmacies':
                if ($request->hasFile('professionalCard')) {
                    $imageName = time() . '_' . uniqid() . '.' . $request->file('professionalCard')->getClientOriginalExtension();
                    $request->file('professionalCard')->move(storage_path('app/public/upload/doctor_assets'), $imageName);
                    $profile->professional_card_path = "/upload/doctor_assets/{$imageName}";
                }

                if ($request->hasFile('exploitationLicense')) {
                    $imageName = time() . '_' . uniqid() . '.' . $request->file('exploitationLicense')->getClientOriginalExtension();
                    $request->file('exploitationLicense')->move(storage_path('app/public/upload/doctor_assets'), $imageName);
                    $profile->exploitation_license_path = "/upload/doctor_assets/{$imageName}";
                }
                break;

            case 'hospital':
                if ($request->hasFile('exploitationLicense')) {
                    $imageName = time() . '_' . uniqid() . '.' . $request->file('exploitationLicense')->getClientOriginalExtension();
                    $request->file('exploitationLicense')->move(storage_path('app/public/upload/doctor_assets'), $imageName);
                    $profile->exploitation_license_path = "/upload/doctor_assets/{$imageName}";
                }
                break;
            // case 4: // Ambulance
            //     $profile = new DoctorProfile();
            //     break;
            default:
                return response()->json([
                    "message" => __('auth.registration.invalid_identity'),
                ], Response::HTTP_BAD_REQUEST);
        }

        $profile->save();
        $this->createService($profile->id);
    }

    private function patientCreate($userId, RegisterRequest $request)
    {
        $profile = new PatientProfile();
        $profile->user_id = $userId;
        $profile->age = $request->input('age');
        $profile->gender = $request->input('gender');
        $profile->height = $request->input('height');
        $profile->weight = $request->input('weight');
        $profile->blood_group = $request->input('bloodGroup');
        $profile->medical_history = $request->input('medicalHistory');
        $profile->save();

        $insurance = new UserInsurance();
        $insurance->patient_profile_id = $profile->id;
        $insurance->insurance_type = $request->input('insuranceType');
        $insurance->insurance_number = $request->input('insuranceNumber');

        switch ($request->input('insuranceType')) {
            case 'public':
                $insurance->assurance_type = $request->input('assuranceType');
                break;
            case 'private':
                $insurance->main_insured = $request->input('mainInsured');
                $insurance->entitled_insured = $request->input('entitledInsured');
                $insurance->assurance_type = $request->input('assuranceType');
                break;
            case 'vietnamese':
                $insurance->registry = $request->input('registry');
                $insurance->registered_address = $request->input('registeredAddress');
                $insurance->valid_from = $request->input('validFrom');
                break;
            default:
                return response()->json([
                    "message" => __('auth.registration.invalid_insurance'),
                ], Response::HTTP_BAD_REQUEST);
        }

        $insurance->save();
    }

    private function createSettings($userId)
    {
        $notificationSettingsName = ["system", "promotion", "sms", "push"];
        $messagesSettingsName = ["delivery", "appearance", "privacy", "backup"];

        for ($i = 0; $i < 4; $i++) {
            $notificationSetting = new UserSetting();
            $notificationSetting->user_id = $userId;
            $notificationSetting->name = $notificationSettingsName[$i];
            $notificationSetting->value = 1;
            $notificationSetting->save();

            $messageSetting = new UserSetting();
            $messageSetting->user_id = $userId;
            $messageSetting->name = $messagesSettingsName[$i];
            $messageSetting->value = 1;
            $messageSetting->save();
        }
    }

    private function createService($doctorProfileId)
    {
        $serviceName = ["Home", "Video appointment", "Clinic", "Online visit"];
        $serviceDescription = ["Schedule doctor to visit your home", "Book a video call with doctor", "Schedule an office visit", "Book a video call with doctor"];
        $serviceIcon = ["assets/icons/home_2.svg", "assets/icons/video_on.svg", "assets/icons/first_aid_kit.svg", "assets/icons/online.svg"];

        for ($i = 0; $i < 4; $i++) {
            $service = new Service();
            $service->doctor_profile_id = $doctorProfileId;
            $service->icon = $serviceIcon[$i];
            $service->name = $serviceName[$i];
            $service->description = $serviceDescription[$i];
            $service->price = 0;
            $service->duration = 0;
            $service->buffer_time = 0;
            $service->is_active = 0;
            $service->save();
        }
    }

    public function passwordResetRequest(Request $request)
    {
        $rules = [
            'countryCode' => 'required|string',
            'phone' => 'required|string',
        ];

        $messages = [
            'countryCode.required' => "Country Code is required",
            'countryCode.string' => "Country Code must be string",
            'phone.required' => "Phone number is required",
            'phone.string' => "Phone number must be string",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('country_code', $request->input('countryCode'))
            ->where('phone', $request->input('phone'))
            ->first();

        if (!$user) {
            return response()->json([
                "message" => "User not found",
            ], Response::HTTP_NOT_FOUND);
        }

        //TODO: Implement password reset logic here (e.g., send email or SMS with reset link)
        //* for now, we will just return a success message
        return response()->json([
            "message" => "success",
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                "message" => "Logout successful",
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "User not authenticated",
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function tokenCheck(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                "message" => "Token is valid",
                "userType" => $user->user_type,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Token is invalid",
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function mailCheck(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => 'email is required',
            'email.email' => 'email must be a valid email address',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], Response::HTTP_BAD_REQUEST);
        }

        if (User::where('email', $request->input('email'))->count() == 0) {
            return response()->json([
                "message" => 'email does not exist',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            "message" => 'email already exists',
        ], Response::HTTP_OK);
    }
}
