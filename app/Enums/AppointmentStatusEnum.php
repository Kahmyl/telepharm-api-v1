<?php

namespace App\Enums;

enum DurationEnum: string
{
    case Accepted = "accepted";
    case Pending = "pending";
    case Rejected = "rejected";
    case Finished = "finished";
}
