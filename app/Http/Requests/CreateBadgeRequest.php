<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBadgeRequest extends FormRequest
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
            'label'=>'required|max:255|unique:badges',
            'description'=>'required|max:255',
            'pictogram'=>'required',
            'color'=>'required', // Add regex ? 
            'type'=>'required',
            'criterium'=>'required',
        ];
    }
}
