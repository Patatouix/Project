<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalUpdateRequest extends FormRequest
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
            'name' => 'required|max:100',
            'age_id' => 'required',
            'weight_id' => 'required',
            'gender_id' => 'required',
            'sterilization_id' => 'required',
            'espece_id' => 'required',
            'race_id' => 'required',
            'food_id' => 'required',
            'sport_id' => 'required',
            'environment_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
