<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\SymptomsEnum;
use App\Enums\DurationEnum;
use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;





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
        'patient_id',
        'type'
    ];

    protected $casts = [
        'symptoms' => SymptomsEnum::class,
        'duration' => DurationEnum::class,
        'status' => AppointmentStatusEnum::class,
        'type' => AppointmentTypeEnum::class
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }


}
