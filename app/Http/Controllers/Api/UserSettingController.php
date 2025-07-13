<?php

namespace App\Http\Controllers\Api;

use App\Models\UserSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

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

        $notifationSettingsName = ['notification', 'promotion', 'sms', 'appNotification'];
        $messageSettingsName = ['message', 'customMessage', 'messagePrivacy', 'messageBackup'];

        $notifationSettings = $settings->whereIn('name', $notifationSettingsName)->pluck('value', 'name');
        $messageSettings = $settings->whereIn('name', $messageSettingsName)->pluck('value', 'name');

        $data = [
            'notificationSettings' => $notifationSettings,
            'messageSettings' => $messageSettings
        ];

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Update user settings
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserSetting(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:10',
                'value' => 'required|boolean',
            ]);

            $user = Auth::user();

            DB::beginTransaction();

            UserSetting::where('user_id', $user->id)
                ->where('name', $request->name)
                ->update(['value' => $request->value]);

            DB::commit();

            return response()->json(['success' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
