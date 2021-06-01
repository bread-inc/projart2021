<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
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
            "picture" => "required|image|mimes:jpeg,jpg,png|max:2048",
            "description" => "required|max:255",
            "radius" => "required",
            "quiz_id" => "required",
            "coord_x" => "required",
            "coord_y" => "required"
        ];
    }
}
