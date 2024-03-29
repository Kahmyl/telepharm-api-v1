<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;



class UserController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|confirmed',
            'phone_number' => 'required',
            'is_doctor' => 'required|boolean'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'is_doctor' => $fields['is_doctor'],
            'phone_number' => $fields['phone_number'],
            'password' => bcrypt($fields['password'])

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(
                [
                    'message' => 'Invalid credentials'
                ],
                401
            );
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function getUser(Request $request)
    {

        $user_id = $request->user()->id;
        $user = User::where('id', $user_id)->first();

        $response = [
            'user' => $user,
        ];

        return response($response, 200);
    }
}
