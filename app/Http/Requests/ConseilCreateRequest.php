<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConseilCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'text' => 'required',
            'conseiltag_id' => 'required',
            'environment_id' => 'required',
            'espece_id' => 'required',
            'food_id' => 'required',
            'gender_id' => 'required',
            'race_id' => 'required',
            'sport_id' => 'required',
            'sterilization_id' => 'required',
            'weight_id' => 'required'
        ];
    }
}
