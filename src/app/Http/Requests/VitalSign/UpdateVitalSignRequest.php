<?php

namespace App\Http\Requests\VitalSign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVitalSignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admission_id' => ['required', 'integer', 'exists:admissions,id'],
            'encounter_id' => ['nullable', 'integer', 'exists:encounters,id'],
            'observation_at' => ['required', 'date'],
            'respiratory_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'spo2' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'systolic_bp' => ['nullable', 'integer'],
            'diastolic_bp' => ['nullable', 'integer'],
            'heart_rate' => ['nullable', 'integer'],
            'temperature' => ['nullable', 'numeric'],
            'recorded_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'admission_id.required' => 'The admission ID is required.',
            'admission_id.exists' => 'The selected admission does not exist.',
            'encounter_id.exists' => 'The selected encounter does not exist.',
            'observation_at.required' => 'The observation date and time is required.',
            'observation_at.date' => 'The observation date and time must be a valid date.',
            'respiratory_rate.integer' => 'The respiratory rate must be an integer.',
            'respiratory_rate.min' => 'The respiratory rate must be at least 0.',
            'respiratory_rate.max' => 'The respiratory rate must not exceed 100.',
            'spo2.numeric' => 'The SpO2 must be a number.',
            'spo2.min' => 'The SpO2 must be at least 0.',
            'spo2.max' => 'The SpO2 must not exceed 100.',
            'recorded_by.required' => 'The recorded by user is required.',
            'recorded_by.exists' => 'The selected user does not exist.',
        ];
    }
}
