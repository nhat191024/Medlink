<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Resources\ServiceCollection;
use Symfony\Component\HttpFoundation\Response;

use App\Helper\CacheKey;

class ServiceController extends Controller
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = new CacheKey();
    }

    /**
     * Get user list of services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserServices()
    {
        $user = Auth::user();
        $cacheKey = $this->cacheKey::DOCTOR_SERVICES . $user->id;

        $services = Cache::rememberForever($cacheKey, function () use ($user) {
            $doctorProfile = $user->doctorProfile;
            return $doctorProfile->services;
        });

        return response()->json(['services' => new ServiceCollection($services)], Response::HTTP_OK);
    }

    /**
     * Edit a service.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editService(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'price' => 'required|integer',
            'duration' => 'required|integer',
            'buffer_time' => 'required|integer',
            'is_active' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $service = Service::find($request->id);
            if (!$service) {
                return response()->json([
                    'message' => 'Service not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $service->price = $request->price;
            $service->duration = $request->duration;
            $service->buffer_time = $request->buffer_time;
            $service->is_active = $request->is_active;
            $service->save();

            $user = Auth::user();
            $cacheKey = $this->cacheKey::DOCTOR_SERVICES . $user->id;
            Cache::forget($cacheKey);

            DB::commit();

            return response()->json([
                'message' => 'Service updated successfully',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update service',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
