<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndividualStoreRequest extends FormRequest
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
            'file_id' => ['required'],
            'individual_id' => ['required'], 
            'passport_number' => ['required'], 
            'name' => ['required'], 
            'age' => ['required'], 
            'is_registered' => ['required'], 
            'gender_id' => ['required'], 
            'nationality_id' => ['required'], 
            'relationship_id' => ['required'], 
            'current_phone_number' => ['required'], 
        ];
    }
}
