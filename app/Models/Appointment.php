<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\SymptomsEnum;
use App\Enums\DurationEnum;
use App\Enums\AppointmentStatusEnum;




class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'symptoms', 
        'duration',
        'is_on_medication',
        'medication', 
        'has_drug_allergy',
        'drug_allergy',
        'has_previous_condition',
        'previous_condition',
        'status',
        'doctor_id',
        'patient_id'
    ];

    protected $casts = [
        'symptoms' => SymptomsEnum::class,
        'duration' => DurationEnum::class,
        'status' => AppointmentStatusEnum::class

    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
