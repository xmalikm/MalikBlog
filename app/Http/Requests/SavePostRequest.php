<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Nezadali ste nadpis',
            'text.required' => 'Nezadali ste text',
            'category_id.required' => 'Nezadali ste kategóriu',
        ];
    }
}
