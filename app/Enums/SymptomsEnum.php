<?php

namespace App\Enums;

enum SymptomsEnum: string
{
    case ChestPain = "chest_pain";
    case ChestDiscomfort = "chest_discomfort";
    case ShortnessOfBreath = "shortness_of_breath";
    case PainInNeck = "pain_in_the_neck";
    case Dizziness = "dizziness";
    case RacingHeartbeat = "racing_heartbeat";
    case SlowHeartBeat = "slow_heartbeat";
    case LightHeadedness = "light_headedness";
}
