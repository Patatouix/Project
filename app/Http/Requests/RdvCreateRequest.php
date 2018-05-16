<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RdvCreateRequest extends FormRequest
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
            'request' => 'required|string|max:255',
            'animal_id' => 'required',
            'vet_id' => 'required'
        ];
    }
}
