<?php

namespace App\Http\Requests\Api\BankCards;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'issuer'          => 'required|min:2|max:100',
            'cardholder_name' => 'required|min:2|max:100',
            'number'          => 'required|digits:16',
            'expires_at'      => 'required',
        ];
    }
}
