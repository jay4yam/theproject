<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoyageUpdateRequest extends FormRequest
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
            'title' => 'required|min:5|max:150',
            'subtitle' => 'required|min:5|max:150',
            'intro' => 'required|min:5|max:1000',
            'description' => 'required|min:5|max:5000',
            'price' => 'required|numeric',
            'duree_du_vol' => 'required'
        ];
    }
}
