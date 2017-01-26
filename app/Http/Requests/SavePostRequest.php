<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Trieda urcena na validaciu inputov pri vytvarani alebo editacii clanku
 *
 */
class SavePostRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|max:255',
            'text' => 'required',
            'blog_photo' => 'max:1024|mimes:jpeg,jpg,png,gif'
        ];
    }

    public function messages() {
        return [
            'category_id.required' => 'Nezadali ste kategóriu',
            'title.required' => 'Nezadali ste nadpis',
            'text.required' => 'Nezadali ste text',
            'blog_photo.mimes' => 'Nespravny format obrazku',
            'blog_photo.max' => 'Obrazok moze mat najviac 1Mb',
        ];
    }
}
