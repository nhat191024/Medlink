<?php

namespace App\Helper;

class CacheKey
{
    //use in HomeController
    public const string HOME = 'home';

    //use in DashboardController & UserService
    public const string PATIENT_SUMMARY = 'patient_summary_';
    public const string PATIENT_PROFILE_DATA = 'patient_profile_data_';
    public const string PATIENT_NOTIFICATIONS = 'patient_notifications_';
    public const string DOCTOR_SUMMARY = 'doctor_summary_';
    public const string DOCTOR_APPOINTMENTS_SUMMARY = 'doctor_appointments_summary_';
    public const string DOCTOR_NOTIFICATIONS = 'doctor_notifications_';

    //use in AppointmentController & AppointmentService
    public const string DOCTOR_APPOINTMENTS = 'doctor_appointments_';
    public const string PATIENT_APPOINTMENTS = 'patient_appointments_';
    public const string APPOINTMENT_DETAILS = 'appointment_details_';
    public const string APPOINTMENT_STATISTICS = 'appointment_statistics_';

    //use in SearchController & appointmentService & BookingController
    public const string HEALTH_CATEGORIES_COUNT = 'health_categories_count';
    public const string DOCTOR_LIST_SEARCH_PAGE = 'doctor_list_search_page_';
    public const string DOCTOR_SEARCH = 'doctor_search_';

    //use in ProfileController & ProfileService & BookingController
    public const string DOCTOR_PROFILE = 'doctor_profile_';
    public const string PATIENT_PROFILE = 'patient_profile_';
    public const string PROFILE_STATISTICS = 'profile_statistics_';

    //use in workScheduleService
    public const string WORK_SCHEDULE = 'work_schedule_';

    //use in ServiceController
    public const string DOCTOR_SERVICES = 'doctor_services_';

    //use in NotificationController
    public const string USER_NOTIFICATIONS = 'user_notifications_';
    public const string UNREAD_NOTIFICATIONS_COUNT = 'unread_notifications_count_';

    //use in FavoriteController
    public const string FAVORITE_DOCTORS = 'favorite_doctors_user_';
}
