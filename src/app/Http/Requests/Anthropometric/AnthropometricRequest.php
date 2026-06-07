<?php

namespace App\Http\Requests\Anthropometric;

use Illuminate\Foundation\Http\FormRequest;

class AnthropometricRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'admission_id' => $isUpdate ? 'sometimes|required|exists:admissions,id' : 'required|exists:admissions,id',
            'weight_kg' => [$isUpdate ? 'sometimes' : 'required', 'numeric', 'min:0.1', 'max:500'],
            'height_cm' => [$isUpdate ? 'sometimes' : 'required', 'numeric', 'min:1', 'max:300'],
            'measured_at' => [$isUpdate ? 'sometimes' : 'required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'admission_id.required' => 'The admission ID is required.',
            'admission_id.exists' => 'The selected admission does not exist.',
            'weight_kg.required' => 'The weight is required.',
            'weight_kg.numeric' => 'The weight must be a number.',
            'weight_kg.min' => 'The weight must be at least 0.1 kg.',
            'weight_kg.max' => 'The weight cannot exceed 500 kg.',
            'height_cm.required' => 'The height is required.',
            'height_cm.numeric' => 'The height must be a number.',
            'height_cm.min' => 'The height must be at least 1 cm.',
            'height_cm.max' => 'The height cannot exceed 300 cm.',
            'measured_at.required' => 'The measurement date is required.',
            'measured_at.date' => 'The measurement date must be a valid date.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('weight_kg')) {
            $this->merge([
                'weight_kg' => round((float) $this->input('weight_kg'), 2),
            ]);
        }

        if ($this->has('height_cm')) {
            $this->merge([
                'height_cm' => round((float) $this->input('height_cm'), 2),
            ]);
        }
    }
}
