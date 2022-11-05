<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

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
            $appointments = Appointment::where('doctor_id', $user_id)->get();
        }else {
            $appointments = Appointment::where('patient_id', $user_id);
        }
        $response = [
            "appointments" => $appointments,
            "user" => $request->user()
        ];
        return response()->json($response, 200);

    }

    public function store(Request $request, $doctor_id)
    {
        $fields = $request->validate([
            'symptoms' => 'required|string',
            'duration' => 'required|string',
            'is_on_medication' => 'required|boolean',
            'medication' => 'string',
            'has_drug_allergy' => 'required|boolean',
            'drug_allergy' => 'string',
            'has_previous_condition' => 'required|boolean',
            'previous_condition' => 'string',
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

    

}
