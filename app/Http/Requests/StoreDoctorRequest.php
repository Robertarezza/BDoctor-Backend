<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'photo' => ['required'],
            'specialization' => ['required'],
            'performance' => ['required'],
            'phone_number' => ['required'],
            'studio_address' => ['required'],
            'CV' => ['required'],
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
            'photo.required' => 'Si perga di inserire la foto',
            'specialization.required' => 'Si perga di inserire almeno una specializzazione',
            'performance.required' => 'Si perga di inserire almeno una prstazione',
            'phone_number.required' => 'Si perga di inserire un numero telefonico',
            'studio_address.required' => 'Si prega perga di inserire l\'indirizzo dello studio',
            'CV.required' => 'Si perga di inserire il CV',
        ];
    }
}
