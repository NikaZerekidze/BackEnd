<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Http\Resources\UserResource;



class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create(
            array_merge($request->validated() , ['password' => bcrypt($request->password), 'roles_id'=>User::EMPLOPYER_ROLE ] )
        );

        $token = $user->createToken('token')->plainTextToken;

        $respone=['user'=>new UserResource($user), 'token'=>$token ];

       return response($respone , 201);
    }
}
