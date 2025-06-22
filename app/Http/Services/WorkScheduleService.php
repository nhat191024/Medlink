<?php

namespace App\Http\Services;

use App\Models\WorkSchedule;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Http\Resources\WorkScheduleCollection;

class WorkScheduleService
{

    public function getSortedGroupedWorkSchedule($workSchedules)
    {
        $workSchedules = new WorkScheduleCollection($workSchedules);
        $groupedData = $workSchedules->groupBy('day_of_week');
        $sortedGroupedData = $groupedData->map(function ($dayGroup) {
            return $dayGroup->sortBy('start_time')->values();
        });
        $daysOfWeekOrder = ['Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7,];

        $sortedGroupedData = $sortedGroupedData->sortKeysUsing(function ($key1, $key2) use ($daysOfWeekOrder) {
            return $daysOfWeekOrder[$key1] <=> $daysOfWeekOrder[$key2];
        });

        $sortedGroupedDataArray = $sortedGroupedData->toArray();

        return $sortedGroupedDataArray;
    }

    public function getAvailableWorkSchedule($workSchedules, $doctorId)
    {
        $workSchedules = new WorkScheduleCollection($workSchedules);
        $groupedData = $workSchedules->groupBy('day_of_week');

        // Get next 7 days
        $next7Days = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            $next7Days->push([
                'date' => $date->format('d'),
                'full_date' => $date->format('Y-m-d'),
                'day_of_week' => $date->format('l'),
                'month' => $date->format('M') // Add month here
            ]);
        }

        // Get doctor's appointments
        $appointments = Appointment::where('doctor_profile_id', $doctorId)
            ->whereBetween('date', [
                Carbon::now()->format('Y-m-d'),
                Carbon::now()->addDays(6)->format('Y-m-d')
            ])
            ->whereIn('status', ['2', '3'])
            ->get()
            ->groupBy('date');

        $result = [];

        foreach ($next7Days as $day) {
            if ($groupedData->has($day['day_of_week'])) {
                $timeSlots = [];

                foreach ($groupedData[$day['day_of_week']] as $schedule) {
                    if ($schedule->all_day == 0) {
                        $startTime = Carbon::parse($schedule->start_time);

                        $isAvailable = true;
                        if (isset($appointments[$day['full_date']])) {
                            foreach ($appointments[$day['full_date']] as $appointment) {
                                $times = explode(' - ', $appointment->time);
                                $appointmentStart = $times[0] = date("g:i A", strtotime($times[0]));
                                if ($startTime != null && $appointmentStart === $startTime->format('g:i A')) {
                                    $isAvailable = false;
                                    break;
                                }
                            }
                        }

                        $timeSlots[] = [
                            'time' => $startTime != null ? $startTime->format('h:i A') : null,
                            'is_available' => $isAvailable
                        ];
                    } else {
                        $appointmentStart = null;
                        $timeSlots[] = [
                            'time' => 'All day',
                            'is_available' => true
                        ];
                        if (isset($appointments[$day['full_date']])) {
                            foreach ($appointments[$day['full_date']] as $appointment) {
                                $times = explode(' - ', $appointment->time);
                                $appointmentStart = $times[0] = date("g:i A", strtotime($times[0]));
                                $appointmentEnd = $times[1] = date("g:i A", strtotime($times[1]));
                                //count total time of appointment in minutes
                                $appointmentTotalTime = (strtotime($appointmentEnd) - strtotime($appointmentStart)) / 60;
                                $timeSlots[] = [
                                    'time' => $appointmentStart,
                                    'appointment_time' => $appointmentTotalTime,
                                    'is_available' => false
                                ];
                            }
                        }
                    }
                }

                $result[$day['month']][$day['date']] = $timeSlots;
            } else {
                // Add empty slot with is_available = false for days without schedule
                $result[$day['month']][$day['date']] = [[
                    'time' => null,
                    'is_available' => false
                ]];
            }
        }

        return $result;
    }

    public function getAvailableWorkScheduleFromDate($workSchedules, $doctorProfileId, $startDate)
    {
        $workSchedules = new WorkScheduleCollection($workSchedules);
        $groupedData = $workSchedules->groupBy('day_of_week');

        // Convert startDate to Carbon instance if it's string
        $startDateCarbon = $startDate instanceof Carbon ? $startDate : Carbon::parse($startDate);

        // Get next 7 days from start date
        $next7Days = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = $startDateCarbon->copy()->addDays($i);
            $next7Days->push([
                'date' => $date->format('Y-m-d'),
                'day_of_week' => $date->format('l')
            ]);
        }

        // Get doctor's appointments for selected date range
        $appointments = Appointment::where('doctor_profile_id', $doctorProfileId)
            ->whereBetween('date', [
                $startDateCarbon->format('Y-m-d'),
                $startDateCarbon->copy()->addDays(6)->format('Y-m-d')
            ])
            ->whereIn('status', ['2', '3'])
            ->get()
            ->groupBy('date');

        // Filter and process schedule
        $availableSchedules = collect();
        foreach ($next7Days as $day) {
            if ($groupedData->has($day['day_of_week'])) {
                $daySchedules = $groupedData[$day['day_of_week']]->map(function ($schedule) use ($appointments, $day) {
                    $timeSlot = [
                        'date' => $day['date'],
                        'day_of_week' => $day['day_of_week'],
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'all_day' => $schedule->all_day,
                    ];

                    // Check if there are appointments during this time slot
                    $isAvailable = true;
                    if (isset($appointments[$day['date']])) {
                        foreach ($appointments[$day['date']] as $appointment) {
                            $times = explode(' - ', $appointment->time);
                            if (count($times) !== 2) continue;

                            $appointmentStart = Carbon::parse("{$day['date']} {$times[0]}");
                            $appointmentEnd = Carbon::parse("{$day['date']} {$times[1]}");
                            $scheduleStart = Carbon::parse("{$day['date']} {$schedule->start_time}");
                            $scheduleEnd = Carbon::parse("{$day['date']} {$schedule->end_time}");

                            if (
                                $appointmentStart->between($scheduleStart, $scheduleEnd) ||
                                $appointmentEnd->between($scheduleStart, $scheduleEnd)
                            ) {
                                $isAvailable = false;
                                break;
                            }
                        }
                    }

                    $timeSlot['is_available'] = $isAvailable;
                    return $timeSlot;
                });

                $availableSchedules->push($daySchedules);
            } else {
                $availableSchedules->push(collect([[
                    'date' => $day['date'],
                    'day_of_week' => $day['day_of_week'],
                    'is_available' => false
                ]]));
            }
        }

        return $availableSchedules->flatten(1)->toArray();
    }
}
