<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email:rfc',
            'message' => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'errors'      => $validator->errors()

        ]));
    }

    public function messages()

    {
        return [
            'first_name.required' => 'Il nome è obbligatorio',
            'last_name.required' => 'Il cognome è obbligatorio',
            'email.required' => 'L\'email è obbligatoria',
            'email.email' => 'L\'email inserita non è valida',
            'message.required' => 'Il messaggio è obbligatorio',
        ];
    }
}
