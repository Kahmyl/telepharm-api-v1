<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\AppointmentStatusEnum;
use Illuminate\Validation\Rules\Enum;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        if ($request->user()->is_doctor == 1){
            $active_appointments = Appointment::where('doctor_id', $user_id)->where('status', 'accepted')->get();
            $pending_appointments = Appointment::where('doctor_id', $user_id)->where('status', 'pending')->get();

        }else {
            $active_appointments = Appointment::where('patient_id', $user_id)->where('status', 'accepted')->get();
            $pending_appointments = Appointment::where('patient_id', $user_id)->where('status', 'accepted')->get();
        }       
        $response = [
            "active_appointments" => $active_appointments,
            "pending_appointments" => $pending_appointments,
            "number_of_active_appointments" => $active_appointments->count(),
            "number_of_pending_appointments" => $pending_appointments->count()
        ];
        return response()->json($response, 200);

    }

    public function store(Request $request, $doctor_id)
    {
        $fields = $request->validate([
            'symptoms' => 'required|string',
            'duration' => 'required|string',
            'is_on_medication' => 'required|boolean',
            'medication' => 'nullable|string',
            'has_drug_allergy' => 'required|boolean',
            'drug_allergy' => 'nullable|string',
            'has_previous_condition' => 'required|boolean',
            'previous_condition' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'symptoms' => $fields['symptoms'],
            'duration' => $fields['duration'],
            'is_on_medication' => $fields['is_on_medication'],
            'has_drug_allergy' => $fields['has_drug_allergy'],
            'has_previous_condition' => $fields['has_previous_condition'],
            'patient_id'=> $request->user()->id,
            'doctor_id'=> $doctor_id
            
        ]);
        $response = [
            'appointment' => $appointment
        ];
        return response()->json($response, 201);
    }

    
    public function show($id)
    {
        return response()->json(Appointment::find($id));
    }


    public function all_doctors(Request $request){
        $doctors = User::where("is_doctor", 1)->get();
        $response = [
            "doctors" => $doctors
        ];
        return response()->json($response, 200);

    }

    public function accept_or_decline_appointment(Request $request, $appointment_id){

        $fields = $request->validate([
            'status' => [new Enum(AppointmentStatusEnum::class)]
        ]);

        $appointment = Appointment::where("id", $appointment_id)->where("doctor_id", $request->user()->id);
        $appointment->update([
            "status", $fields['status']
        ]);

        $response = [
            "message" => "Appointment has been ". $fields['status']. " by Dr. ". $request->user()->name
        ];

        return response()->json($response, 200);
    }


}
