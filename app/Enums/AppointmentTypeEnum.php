<?php

namespace App\Enums;

enum AppointmentTypeEnum: string
{
    case ScheduleAppointment = "schedule_appointment";
    case VideoConsultation = "video_consulation";

}
