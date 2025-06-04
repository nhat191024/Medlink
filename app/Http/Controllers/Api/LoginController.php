<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Service;
use App\Models\UserSetting;

class LoginController extends Controller
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

        /** @var \App\Models\User $user **/  $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            "message" => __('auth.login.success'),
            "userType" => $user->user_type,
            "token" => $token,
        ], Response::HTTP_OK);
    }
}
