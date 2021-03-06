<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
            "picture" => "image|mimes:jpeg,jpg,png|max:2048", // can't be required for the update
            "description" => "required|max:255",
            "end_text" => "string|required",
            "radius" => "required",
            "coord_x" => "required",
            "coord_y" => "required",
        ];
    }
}
