<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkSchedule;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Services\WorkScheduleService;

use Symfony\Component\HttpFoundation\Response;

class WorkScheduleController extends Controller
{
    private $workScheduleService;

    public function __construct()
    {
        $this->workScheduleService = app(WorkScheduleService::class);
    }

    /**
     * Get the work schedule
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWorkSchedule()
    {
        $user = Auth::user();
        $doctorProfile = $user->doctorProfile;
        $workSchedule = $doctorProfile->workSchedules;

        $cacheKey = 'work_schedule_' . $user->id;

        $workSchedules = Cache::rememberForever($cacheKey, function () use ($workSchedule) {
            return $this->workScheduleService->getSortedGroupedWorkSchedule($workSchedule);
        });

        return response()->json($workSchedules, Response::HTTP_OK);
    }

    /**
     * Add work schedule
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addWorkSchedule(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'work_schedule' => 'required|json',
            ]);

            $user = Auth::user();
            $doctorProfile = $user->doctorProfile;

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $workSchedules = json_decode($request->work_schedule, true);

            WorkSchedule::where('doctor_profile_id', $doctorProfile->id)->delete();
            foreach ($days as $day) {
                if (isset($workSchedules[$day])) {
                    foreach ($workSchedules[$day] as $workSchedule) {
                        $allDay = $workSchedule['all_day'] == 'true' ? 1 : 0;
                        $start_time = Carbon::parse($workSchedule['start_time'])->format('H:i:s');
                        $end_time = Carbon::parse($workSchedule['end_time'])->format('H:i:s');

                        $user = Auth::user();
                        $doctorProfile = $user->doctorProfile;
                        $workSchedule = new WorkSchedule();
                        $workSchedule->doctor_profile_id = $doctorProfile->id;
                        $workSchedule->day_of_week = $day;
                        if ($allDay == 1) {
                            $workSchedule->all_day = $allDay;
                            $workSchedule->save();
                            break;
                        }
                        $workSchedule->start_time = $start_time;
                        $workSchedule->end_time =  $end_time;
                        $workSchedule->save();
                    }
                }
            }

            DB::commit();

            $cacheKey = 'work_schedule_' . $user->id;
            Cache::forget($cacheKey);

            return response()->json([
                'message' => 'Work schedule added successfully'
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Invalid work schedule format',
                'errors' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete a work schedule
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWorkSchedule(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required|integer|exists:work_schedules,id',
            ]);

            $workSchedule = WorkSchedule::find($request->id);
            $workSchedule->delete();

            DB::commit();

            $user = Auth::user();
            $cacheKey = 'work_schedule_' . $user->id;
            Cache::forget($cacheKey);

            return response()->json([
                'message' => 'Work schedule deleted successfully',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Invalid request data',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
