<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'title' => 'required|max:200',
            'intro' => 'required|max:1000',
            'slug' => 'required',
            'contentArticle' => 'required',
            'main_image' => 'image',
            'is_public' => 'required',
            'user_id' => 'exists:users,id'
        ];
    }
}
