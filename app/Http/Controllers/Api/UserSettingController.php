<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class UserSettingController extends Controller
{
    /**
     * Get user settings for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserSetting(Request $request)
    {
        $user = Auth::user();
        $settings = $user->settings;

        return response()->json([$settings], Response::HTTP_OK);
    }
}
