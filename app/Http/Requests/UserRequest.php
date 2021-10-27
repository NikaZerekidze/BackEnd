<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    // TODO add validation custums messages
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:20'],
             'email' => ['required', 'unique:users', 'email'],
             'password' => ['min:6', 'max:50'],
             'company_id' => [],
             'roles_id' => [],
        ];
    }
}
