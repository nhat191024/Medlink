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
            ->whereIn('status', ['pending', 'upcoming'])
            ->get()
            ->groupBy('date');

        $result = [];

        foreach ($next7Days as $day) {
            if ($groupedData->has($day['day_of_week'])) {
                $timeSlots = [];

                // Check if there's an all-day schedule for this day
                $hasAllDaySchedule = $groupedData[$day['day_of_week']]->contains('all_day', 1);

                if ($hasAllDaySchedule) {
                    // Only generate all-day time slots
                    // Morning slots: 7:00 AM to 10:00 AM
                    $morningSlots = [
                        '07:00',
                        '08:00',
                        '09:00',
                        '10:00'
                    ];

                    // Afternoon slots: 1:00 PM to 4:00 PM
                    $afternoonSlots = [
                        '13:00',
                        '14:00',
                        '15:00',
                        '16:00'
                    ];

                    $allDaySlots = array_merge($morningSlots, $afternoonSlots);

                    foreach ($allDaySlots as $timeSlot) {
                        $slotTime = Carbon::parse($timeSlot);
                        $isAvailable = true;

                        // Kiểm tra nếu time slot đã qua so với thời gian hiện tại (chỉ cho ngày hôm nay)
                        if ($day['full_date'] === Carbon::now()->format('Y-m-d')) {
                            $slotDateTime = Carbon::parse($day['full_date'] . ' ' . $timeSlot);
                            if ($slotDateTime->isPast()) {
                                $isAvailable = false;
                            }
                        }

                        if ($isAvailable && isset($appointments[$day['full_date']])) {
                            foreach ($appointments[$day['full_date']] as $appointment) {
                                $times = explode(' - ', $appointment->time);
                                $appointmentStart = $times[0] = date("g:i A", strtotime($times[0]));
                                if ($appointmentStart === $slotTime->format('g:i A')) {
                                    $isAvailable = false;
                                    break;
                                }
                            }
                        }

                        $timeSlots[] = [
                            'time' => $slotTime->format('h:i A'),
                            'is_available' => $isAvailable
                        ];
                    }
                } else {
                    // Process regular time slots (non-all-day)
                    foreach ($groupedData[$day['day_of_week']] as $schedule) {
                        if ($schedule->all_day == 0) {
                            $startTime = Carbon::parse($schedule->start_time);

                            $isAvailable = true;

                            // Kiểm tra nếu time slot đã qua so với thời gian hiện tại (chỉ cho ngày hôm nay)
                            if ($day['full_date'] === Carbon::now()->format('Y-m-d')) {
                                $slotDateTime = Carbon::parse($day['full_date'] . ' ' . $schedule->start_time);
                                if ($slotDateTime->isPast()) {
                                    $isAvailable = false;
                                }
                            }

                            if ($isAvailable && isset($appointments[$day['full_date']])) {
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
                                'time' => $startTime?->format('h:i A'),
                                'is_available' => $isAvailable
                            ];
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
                // Check if there's an all-day schedule for this day
                $hasAllDaySchedule = $groupedData[$day['day_of_week']]->contains('all_day', 1);

                if ($hasAllDaySchedule) {
                    // Generate all-day time slots
                    $morningSlots = ['07:00', '08:00', '09:00', '10:00'];
                    $afternoonSlots = ['13:00', '14:00', '15:00', '16:00'];
                    $allDaySlots = array_merge($morningSlots, $afternoonSlots);

                    $daySchedules = collect();
                    foreach ($allDaySlots as $timeSlot) {
                        $slotTime = Carbon::parse($timeSlot);
                        $isAvailable = true;

                        if (isset($appointments[$day['date']])) {
                            foreach ($appointments[$day['date']] as $appointment) {
                                $times = explode(' - ', $appointment->time);
                                $appointmentStart = $times[0] = date("g:i A", strtotime($times[0]));
                                if ($appointmentStart === $slotTime->format('g:i A')) {
                                    $isAvailable = false;
                                    break;
                                }
                            }
                        }

                        $daySchedules->push([
                            'date' => $day['date'],
                            'day_of_week' => $day['day_of_week'],
                            'start_time' => $timeSlot,
                            'end_time' => Carbon::parse($timeSlot)->addHour()->format('H:i'),
                            'all_day' => 1,
                            'is_available' => $isAvailable
                        ]);
                    }

                    $availableSchedules->push($daySchedules);
                } else {
                    // Process regular schedules (non-all-day)
                    $daySchedules = $groupedData[$day['day_of_week']]->filter(function ($schedule) {
                        return $schedule->all_day == 0;
                    })->map(function ($schedule) use ($appointments, $day) {
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
                }
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
