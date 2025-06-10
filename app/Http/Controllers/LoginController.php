<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
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
            'email.required' => 'Vui lòng nhập email hoặc số điện thoại.',
            'email.email' => 'Email không đúng định dạng.',
            'email.regex' => 'Số điện thoại không đúng định dạng. VD: 0901234567 hoặc +1 (602) 384-7437',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.regex' => 'Mật khẩu phải có ít nhất 6 chữ cái, 1 số và 1 ký tự đặc biệt (&, $, #, %).',
        ];

        $request->validate($rules, $messages);

        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password])) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput($request->only('email'));
    }
}
