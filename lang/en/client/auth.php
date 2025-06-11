<?php
return [
    'welcome' => 'Welcome back',
    'fields' => [
        'label' => [
            'login' => 'Email or phone number',
            'password' => 'Password',
        ],

        'placeholder' => [
            'login' => 'Enter your email or phone number',
            'password' => 'Enter your password',
        ],
    ],
    'forgot_password' => 'Forgot your password?',

    'validation' => [
        'email_required' => 'Please enter your email or phone number.',
        'email_email' => 'Email format is incorrect.',
        'email_regex' => 'Phone number format is incorrect. E.g., 0901234567 or +1 (602) 384-7437',
        'password_required' => 'Please enter your password.',
        'password_min' => 'Password must be at least 8 characters long.',
        'password_regex' => 'Password must contain at least 6 letters, 1 number, and 1 special character (&, $, #, %).',
        'password_wrong' => 'Login information is incorrect.',
    ],

    'button' => [
        'login' => 'Login',
        'register' => 'Register',
    ],
];
