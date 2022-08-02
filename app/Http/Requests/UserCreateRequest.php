<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users,',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'wallet_balance' => 'required|integer',
            'profile_picture' => 'nullable|image',
        ];
        
    }
}
