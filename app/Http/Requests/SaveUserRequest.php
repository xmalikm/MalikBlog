<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'email' => 'required|email',
            'profile_photo' => 'max:1024|mimes:jpeg,jpg,png,gif'
        ];
    }

    public function message() {
        return [
            'name.required' => 'Nezadal si meno',
            'name.max' => 'Meno moze mat najviac 20 znakov',
            'email.required' => 'Nezadal si e-mail',
            'email.unique' => 'Tento e-mail uz existuje',
            'profile_photo.mimes' => 'Nespravny format obrazku',
            'profile_photo.max' => 'Obrazok moze mat najviac 1Mb',
        ];
    }
}
