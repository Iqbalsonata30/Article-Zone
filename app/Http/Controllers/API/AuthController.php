<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $request->validated();
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        $token = $user->createToken('Project-Zone-Token')->plainTextToken;
        if ($user) {
            return response([
                'status'    => true,
                'user'      => $user,
                'token'     => $token
            ], 201)->header('Content-Type', 'application/json');
        } else {
            return response([
                'status'    => false,
                'message'   => 'Users Registered failed.'
            ], 401)->header('Content-Type', 'application/json');
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'status'    => true,
            'message'   => 'User Logout successfully.'
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);
        $user = User::firstWhere('email', $request->email);
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Project-Zone-Token')->plainTextToken;
                return response([
                    'status'    => true,
                    'user'      => $user,
                    'token'     => $token
                ], 200)->header('Content-Type', 'application/json');
            }
            return response([
                'status'    => false,
                'message'   => 'Data doesnt match. '
            ], 400)->header('Content-Type', 'application/json');
        }

        return response([
            'status'    => false,
            'message'   => 'User could not be found.'
        ], 400)->header('Content-Type', 'application/json');
    }
}
