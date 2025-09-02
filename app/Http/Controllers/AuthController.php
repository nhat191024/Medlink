<?php

namespace App\Http\Controllers;

use App\Models\PatientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserInsurance;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSplashForm()
    {
        return view('auth.splash');
    }

    public function showLoginForm()
    {
        // dd(User::find(25));
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $loginInput = $request->input('email');

        $password = $request->input('password');
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $rules = [
            'email' => 'required|string',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z]{6,})(?=.*\d)(?=.*[&$#%]).+$/',
        ];

        $rules['email'] = $fieldType === 'phone'
            ? 'required|string|regex:/^[0-9]{9,11}$/'
            : 'required|string|email';

        $messages = [
            'email.required' => __('client/auth.validation.email_required'),
            'email.email' => __('client/auth.validation.email_email'),
            'email.regex' => __('client/auth.validation.email_regex'),
            'password.required' => __('client/auth.validation.password_required'),
            'password.min' => __('client/auth.validation.password_min'),
            'password.regex' => __('client/auth.validation.password_regex'),
        ];

        $request->validate($rules, $messages);
        $loginInput = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ?  trim($loginInput) : $this->removeZero(trim($loginInput));
        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password])) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => __('client/auth.validation.password_wrong'),
        ])->withInput($request->only('email'));
    }

    public function phoneRegisterSubmit(Request $request)
    {
        $request->validate([
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|regex:/^[0-9]{9,11}$/',
        ], [
            'country_code.required' => __('client/auth.validation.country_code_required'),
            'phone.required' => __('client/auth.validation.phone_required'),
            'phone.regex' => __('client/auth.validation.phone_regex'),
        ]);

        // Check if phone number already exists in users table
        $fullPhone = $request->input('country_code') . $request->input('phone');
        if (User::where('phone', $fullPhone)->exists()) {
            return back()->withErrors([
                'phone' => __('client/auth.validation.phone_exists'),
            ])->withInput($request->only('country_code', 'phone'));
        }
        $countryCode = $request->input('country_code');
        $phone = $request->input('phone');
        $request->session()->put('user.country_code', $countryCode);
        $request->session()->put('user.phone', $phone);

        return redirect()->route('register.otp');
    }

    public function otpRegisterSubmit(Request $request)
    {




        return redirect()->route('register.create-account');
    }

    public function createAccountRegisterSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z]{6,})(?=.*\d)(?=.*[&$#%]).+$/',
        ], [
            'email.required' => __('client/auth.validation.email_required'),
            'email.email' => __('client/auth.validation.email_email'),
            'email.unique' => __('client/auth.validation.email_unique'),
            'password.required' => __('client/auth.validation.password_required'),
            'password.min' => __('client/auth.validation.password_min'),
            'password.regex' => __('client/auth.validation.password_regex'),
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $request->session()->put('user.email', $email);
        $request->session()->put('user.password', $password);

        return redirect()->route('register.profile');
    }

    public function profileRegisterSubmit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:male,female,other',
            'height' => 'required|numeric|min:0.5|max:2.5',
            'weight' => 'required|numeric|min:2|max:500',
            'blood_group' => 'required|string|max:3',
            'medical_history' => 'nullable|string|max:1000',
            'insurance_type' => 'required|in:public,private,vietnamese',
            'insurance_number' => 'required|string|max:50',
            'valid_from' => 'nullable|date',
            'registry' => 'nullable|string|max:255',
            'registered_address' => 'nullable|string|max:255',
            'assurance_type' => 'nullable|string|max:255',
            'main_insured' => 'nullable|string|max:255',
            'entitled_insured' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
        ], [
            'full_name.required' => __('client/auth.validation.full_name_required'),
            'age.required' => __('client/auth.validation.age_required'),
            'gender.required' => __('client/auth.validation.gender_required'),
            'height.required' => __('client/auth.validation.height_required'),
            'weight.required' => __('client/auth.validation.weight_required'),
            'blood_group.required' => __('client/auth.validation.blood_group_required'),
            'insurance_type.required' => __('client/auth.validation.insurance_type_required'),
            'insurance_number.required' => __('client/auth.validation.insurance_number_required'),
            'address.required' => __('client/auth.validation.address_required'),
        ]);
        // dd ($request->all());
        $full_name = $request->input('full_name');
        $request->session()->put('user.full_name', $full_name);

        $age = $request->input('age');
        $request->session()->put('user.age', $age);

        $gender = $request->input('gender');
        $request->session()->put('user.gender', $gender);

        $height = $request->input('height');
        $request->session()->put('user.height', $height);

        $weight = $request->input('weight');
        $request->session()->put('user.weight', $weight);

        $blood_group = $request->input('blood_group');
        $request->session()->put('user.blood_group', $blood_group);

        $medical_history = $request->input('medical_history');
        $request->session()->put('user.medical_history', $medical_history);

        $insurance_type = $request->input('insurance_type');
        $request->session()->put('user.insurance_type', $insurance_type);

        $insurance_number = $request->input('insurance_number');
        $request->session()->put('user.insurance_number', $insurance_number);

        $valid_from = $request->input('valid_from');
        $request->session()->put('user.valid_from', $valid_from);

        $registry = $request->input('registry');
        $request->session()->put('user.registry', $registry);

        $registered_address = $request->input('registered_address');
        $request->session()->put('user.registered_address', $registered_address);

        $assurance_type = $request->input('assurance_type');
        $request->session()->put('user.assurance_type', $assurance_type);

        $main_insured = $request->input('main_insured');
        $request->session()->put('user.main_insured', $main_insured);

        $entitled_insured = $request->input('entitled_insured');
        $request->session()->put('user.entitled_insured', $entitled_insured);

        $address = $request->input('address');
        $request->session()->put('user.address', $address);
        return redirect()->route('register.avatar');
    }

    public function avatarRegisterSubmit(Request $request)
    {
        // dd(($request->session()->get('user')));
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'avatar.required' => __('client/auth.validation.avatar_required'),
            'avatar.image' => __('client/auth.validation.avatar_image'),
            'avatar.mimes' => __('client/auth.validation.avatar_mimes'),
            'avatar.max' => __('client/auth.validation.avatar_max'),
        ]);
        $newUser = $request->session()->get('user');
        try {
            DB::beginTransaction();

            $user = new User();
            $user->phone = $newUser['phone'];
            $user->country_code = $newUser['country_code'];
            $user->user_type = "patient";
            $user->email = $newUser['email'];
            $user->password = Hash::make($newUser['password']);
            $user->name = $newUser['full_name'];
            $user->address = $newUser['address'];
            $user->gender = $newUser['gender'];
            if ($request->hasFile('avatar')) {
                $imageName = time() . '_' . uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(storage_path('app/public/uploads/avatar/'), $imageName);
                $user->avatar = "/uploads/avatar/{$imageName}";
            } else {
                $user->avatar = "/uploads/avatar/default.png";
            }
            $user->save();
            $this->patientCreate($user->id, $request, $newUser);

            $request->session()->forget('user');

            DB::commit();
            return redirect()->route('register.progress');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password-phone');
    }

    public function sendOtp(Request $request)
    {
        $phone = $request->input('phone');
        $countryCode = $request->input('country_code');
        $request->validate([
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|regex:/^[0-9]{9,11}$/',
        ], [
            'country_code.required' => __('client/auth.validation.country_code_required'),
            'phone.required' => __('client/auth.validation.phone_required'),
            'phone.regex' => __('client/auth.validation.phone_regex'),
        ]);
        $request->session()->put('forgot_password.country_code', $countryCode);
        $request->session()->put('forgot_password.phone', $this->removeZero($phone));
        $fullPhone =  $this->removeZero($phone);

        if (User::where('country_code', $countryCode)->where('phone', $fullPhone)->exists()) {
            return redirect()->route('forgot-password.otp');
        } else {
            return back()->withErrors([
                'phone' => __('client/auth.validation.phone_not_found'),
            ])->withInput($request->only('country_code', 'phone'));
        }
    }

    public function removeZero(string $phone)
    {
        if (str_starts_with($phone, '0')) {
            return substr($phone, 1);
        }
        return $phone;
    }

    public function verifyOtp(Request $request)
    {
        return redirect()->route('forgot-password.reset');
    }

    public function showResetForm()
    {
        return view('auth.forgot-password-reset');
    }

    public function resetPassword(Request $request)
    {
        try {

            $request->validate([
                'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z]{6,})(?=.*\d)(?=.*[&$#%]).+$/',
                'password_confirmation' => 'required|same:password',
            ], [
                'password.required' => __('client/auth.validation.password_required'),
                'password.min' => __('client/auth.validation.password_min'),
                'password.regex' => __('client/auth.validation.password_regex'),
                'password_confirmation.required' => __('client/auth.validation.password_confirmation_required'),
                'password_confirmation.same' => __('client/auth.validation.password_mismatch'),
            ]);
            $countryCode = $request->session()->get('forgot_password.country_code');
            $phone = (string) $request->session()->get('forgot_password.phone');
            $password = $request->input('password');
            $passwordConfirmation = $request->input('password_confirmation');
            $user = User::where('country_code', $countryCode)
                ->where('phone', $this->removeZero($phone))
                ->first();
            // dd($request->all(),$user, $this->removeZero($phone));

            if (!$user) {
                return back()->withErrors([
                    'password' => __('client/auth.validation.phone_not_found'),
                ])->withInput($request->only('password', 'password_confirmation'));
            }
            if ($password !== $passwordConfirmation) {
                return back()->withErrors([
                    'password' => __('client/auth.validation.password_mismatch'),
                ])->withInput($request->only('password', 'password_confirmation'));
            }

            // Update the user's password
            $user->password = Hash::make($password);
            $user->save();
            $request->session()->forget('forgot_password');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'password' => __('client/auth.error'),
            ]);
        }
        return redirect()->route('login')->with('status', 'Password has been reset successfully!');
    }

    private function patientCreate($userId, Request $request, $newUser = null)
    {

        $profile = new PatientProfile();
        $profile->user_id = $userId;
        $profile->age = $newUser['age'];
        // $profile->gender = $newUser['gender'];
        $profile->height = $newUser['height'];
        $profile->weight = $newUser['weight'];
        $profile->blood_group = $newUser['blood_group'];
        $profile->medical_history = $newUser['medical_history'];
        $profile->save();

        $insurance = new UserInsurance();
        $insurance->patient_profile_id = $profile->id;
        $insurance->insurance_type = $newUser['insurance_type'];
        $insurance->insurance_number = $newUser['insurance_number'];

        switch ($newUser['insurance_type']) {
            case 'public':
                $insurance->assurance_type = $newUser['assurance_type'];
                break;
            case 'private':
                $insurance->main_insured = $newUser['main_insured'];
                $insurance->entitled_insured = $newUser['entitled_insured'];
                $insurance->assurance_type = $newUser['assurance_type'];
                break;
            case 'vietnamese':
                $insurance->registry = $newUser['registry'];
                $insurance->registered_address = $newUser['registered_address'];
                $insurance->valid_from = $newUser['valid_from'];
                break;
            default:
                return;
        }

        $insurance->save();
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }
}
