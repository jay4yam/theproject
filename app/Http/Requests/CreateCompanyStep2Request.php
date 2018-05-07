<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyStep2Request extends FormRequest
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
            'raison_sociale' => 'required|max:100',
            'adresse' => 'required|max:100',
            'code_postal' => 'required|max:5',
            'ville' => 'required|max:50',
            'telephone' => 'required',
            'email' => 'required|email|max:50',
            'mail_resa' => 'required|email|max:50',
            'num_licence' => 'required||max:50',
            'baseline' => 'required|max:200',
            'intro' => 'required|max:500',
            'presentation' => 'required',
            'logo' => 'image',
            'background_image' => 'image'

        ];
    }
}
