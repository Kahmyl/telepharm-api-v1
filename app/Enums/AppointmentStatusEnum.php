<?php

namespace App\Enums;

enum AppointmentStatusEnum: string
{
    case Accepted = "accepted";
    case Pending = "pending";
    case Rejected = "rejected";
    case Finished = "finished";
}
