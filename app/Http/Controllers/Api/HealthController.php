<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Cache;

class HealthController extends Controller
{
    /**
     * Health check endpoint for Docker and monitoring
     */
    public function health()
    {
        $health = [
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'services' => []
        ];

        try {
            // Check database connection
            DB::connection()->getPdo();
            $health['services']['database'] = 'healthy';
        } catch (\Exception $e) {
            $health['services']['database'] = 'unhealthy';
            $health['status'] = 'unhealthy';
        }

        try {
            // Check queue connection
            $queueSize = Queue::size();
            $health['services']['queue'] = [
                'status' => 'healthy',
                'pending_jobs' => $queueSize
            ];
        } catch (\Exception $e) {
            $health['services']['queue'] = 'unhealthy';
            $health['status'] = 'unhealthy';
        }

        try {
            // Check cache
            Cache::put('health_check', 'ok', 5);
            $cached = Cache::get('health_check');
            $health['services']['cache'] = $cached === 'ok' ? 'healthy' : 'unhealthy';
        } catch (\Exception $e) {
            $health['services']['cache'] = 'unhealthy';
        }

        // Check storage permissions
        $storageWritable = is_writable(storage_path());
        $health['services']['storage'] = $storageWritable ? 'healthy' : 'unhealthy';

        if (!$storageWritable) {
            $health['status'] = 'unhealthy';
        }

        $httpStatus = $health['status'] === 'healthy' ? 200 : 503;

        return response()->json($health, $httpStatus);
    }

    /**
     * Simple ping endpoint
     */
    public function ping()
    {
        return response()->json([
            'message' => 'pong',
            'timestamp' => now()->toISOString()
        ]);
    }
}
