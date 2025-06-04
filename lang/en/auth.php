<?php
return [
    'validation' => [
        'required' => ':attribute is required.',
        'email' => ':attribute must be a valid email address.',
        'min' => ':attribute must be at least :min characters.',
        'max' => ':attribute may not be greater than :max characters.',
        'confirmed' => ':attribute confirmation does not match.',
        'unique' => ':attribute has already been taken.',
        'exists' => ':attribute does not exist.',
        'numeric' => ':attribute must be a number.',
        'string' => ':attribute must be a string.',
        'boolean' => ':attribute must be true or false.',
        'date' => ':attribute is not a valid date.',
        'array' => ':attribute must be an array.',
        'file' => ':attribute must be a file.',
        'image' => ':attribute must be an image.',
        'mimes' => ':attribute must be a file of type: :values.',
        'dimensions' => ':attribute has invalid image dimensions.',
        'timezone' => ':attribute must be a valid timezone.',
        'in' => ':attribute must be one of the following: :values.',
        'not_in' => ':attribute must not be one of the following: :values.',
        'regex' => ':attribute format is invalid.',
        'url' => ':attribute must be a valid URL.',
    ],

    'login' => [
        'success' => 'Login successful.',
        'failed' => 'Login failed. Please check your credentials.',
        'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    ],

    'status' => [
        'suspended' => 'Your account has been suspended. Please contact the administrator for more details.',
        'not_approved' => 'Your account has not been approved yet. Please wait for the administrator to approve it.',
    ]
];
