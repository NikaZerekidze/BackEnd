<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class ChangePasswordConroller extends Controller
{
    public function changePassword(ChangePasswordRequest $request){
        $user = Auth::user();
        Gate::authorize('update' , $user);
        
        
        $request->validated();
        
        if(!Hash::check($request['old_password'], $user->password)){
            return response('Password don`t match', 403);
        }elseif ($request['old_password'] == $request['new_password']) {
            return response('new password is same as an old one', 403);
        }
        else {
            User::where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->input('new_password'))
                ]);
            return response('Password has been changed', 200);
        }

        return response('Somthing bad happend, please try later');
        
    }
}
