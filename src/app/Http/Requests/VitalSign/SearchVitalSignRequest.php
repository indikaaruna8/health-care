<?php

namespace App\Http\Requests\VitalSign;

use Illuminate\Foundation\Http\FormRequest;

class SearchVitalSignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'page' => ['nullable', 'integer', 'min:1'],
            'admission_id' => ['nullable', 'integer'],
            'encounter_id' => ['nullable', 'integer'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
            'recorded_by' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'The search term must be a string.',
            'search.max' => 'The search term must not exceed 255 characters.',
            'page.integer' => 'The page must be an integer.',
            'page.min' => 'The page must be at least 1.',
            'date_from.date' => 'The date from must be a valid date.',
            'date_to.date' => 'The date to must be a valid date.',
            'date_to.after_or_equal' => 'The date to must be after or equal to the date from.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'page' => $this->input('page', 1),
        ]);
    }
}
