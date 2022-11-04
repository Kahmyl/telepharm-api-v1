<?php

namespace App\Enums;

enum DurationEnum: string
{
    case OneToThreeDays = "one_to_three_days";
    case FourToSixDays = "four_to_six_days";
    case TwoWeeks = "two_weeks";
    case ThreeWeeks = "three_weeks";
    case OneMonth = "one_month";
    case TwoMonths  = "two_months";
    case ThreeMonths = "three_months";
    case OverSixMonths = "over_six_months";

}
