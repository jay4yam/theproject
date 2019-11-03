<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartAjaxRequest extends FormRequest
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
            'voyageId' => 'required|exists:voyages,id|int',
            'numOfVoyagers' => 'required|numeric',
            'dateDeDepart' =>'date',
            'individualPrice'=> 'required|numeric'
        ];
    }
}
