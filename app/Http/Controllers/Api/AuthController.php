<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function users()
    {
        $data = User::all();
        return send_resonse('Users', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))){
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);
    }

    /*public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        if ($validator->fails())
            return send_error('Validation error', $validator->errors(), 422);

        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)){
            $user = auth()->user();
            $data['name'] = $user->name;
            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            return send_resonse('Successfully logged in', $data);
        } else {
            return send_error('Unauthorised', '', 401);
        }


    }*/

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' =>['required', 'min:6', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    /*public function register(Request $request)
    {


        $validator = Validator::make($request->all(), [
            "name" => "required|min:4",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);


        if ($validator->fails())
            return send_error('Validation error', $validator->errors(), 422);

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $data = [
                'name' => $user->name,
                'email' => $user->email
            ];

            return send_resonse('User registered successfully', $data);

        } catch (\Exception $e) {
            return send_error($e->getMessage(), $e->getCode());
        }

    }*/

    public function getUserById($id)
    {
        $user = User::find($id);
        if($user){
            return send_resonse('User details', $user);
        } else {
            return send_resonse('User not found', $user);
        }

    }

    public function logout()
    {
        Auth::logout();
    }

    /*public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'Successfully Logout'],401);
    }*/
}
