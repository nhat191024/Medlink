<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showSplashForm()
    {
        return view('auth.splash');
    }

    public function showLoginForm()
    {
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
            ? 'required|string|regex:/^\+[0-9]{1,3}[0-9]{10,15}$/'
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

        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password])) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => __('client/auth.validation.password_wrong'),
        ])->withInput($request->only('email'));
    }
}
