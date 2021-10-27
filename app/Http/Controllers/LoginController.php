<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        $variables = $request->validated();


        $user = User::where('email', $variables['email'])->first();

        if (!$user || !Hash::check($variables['password'], $user->password))
        {
            return response('not correct', 401);
        } else {
            $token = $user->createToken('token')->plainTextToken;

            $respone = ['user' => new UserResource($user), 'token' => $token];

            return response($respone, 201);
        }


    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return 'logout';
    }
}
