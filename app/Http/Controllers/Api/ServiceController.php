<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Service;

use App\Http\Resources\ServiceCollection;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    /**
     * Get user list of services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserServices()
    {
        $user = Auth::user();
        $doctorProfile = $user->doctorProfile;
        $services = $doctorProfile->services;

        return response()->json(['services' => new ServiceCollection($services)], Response::HTTP_OK);
    }

    public function editService(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'buffer_time' => 'required|integer',
            'is_active' => 'required|string',
        ]);

        $services = Service::find($request->id);
        $services->name = $request->name;
        $services->description = $request->description;
        $services->price = $request->price;
        $services->duration = $request->duration;
        $services->buffer_time = $request->buffer_time;
        $services->is_active = $request->is_active;
        $services->save();

        return response()->json([
            'message' => 'Service updated successfully',
        ], Response::HTTP_OK);
    }
}
