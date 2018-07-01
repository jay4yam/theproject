<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VilleCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'title' => 'required|min:5|max:500',
            'subtitle' => 'required|min:5|max:500',
            'description' => 'required|min:500|max:5000',
            'main_photo' => 'required|image'
        ];
    }
}
