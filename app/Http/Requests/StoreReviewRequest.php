<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guest_name' => ['required'],
            'guest_mail' => ['required', 'email'],
            'rewiew' => ['required'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'guest_name.required' => 'Si prega di inserire il proprio nome',
            'guest_mail.required' => 'Si prega di inserire la vostra mail',
            'guest_mail.email' => 'E\' stata inserita una mail non valida',
            'rewiew.required' => 'Si prega di inserire la vostra recensione',
        ];
    }
}
