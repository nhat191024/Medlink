<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Support;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    /**
     * Handle the support request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleSupport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
            'appointment_id' => 'nullable|integer|exists:appointments,id', // Optional appointment ID
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        Support::create([
            'user_id' => $request->user()->id,
            'appointment_id' => $request->input('appointment_id', null),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'message' => 'Support request submitted successfully.',
        ], Response::HTTP_CREATED);
    }
}
