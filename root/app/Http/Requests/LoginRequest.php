<?php
/**
 *    request pre prihlasenie sa do aplikacie
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * validacne pravidla pre inputy formularu
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    /**
     *    custom spravy errorov
     */
    public function messages() {
        return [
            'email.required' => 'Nezadali ste prihlasovací e-mail',
            'password.required' => 'Nezadali ste prihlasovacie heslo'
        ];
    }   
}
