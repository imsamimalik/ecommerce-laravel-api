<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() == request()->user();
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
            'username' => 'required|max:50|unique:users,username'.Auth::id(),
            'email' => 'required|email|unique:users,email'.Auth::id(),
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'wallet_balance' => 'required|integer',
            'profile_picture' => 'nullable|file',
        ];
    }
}
