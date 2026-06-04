<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrganizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('organizations', 'slug'),
            ],

            'type' => [
                'required',
                'string',
                Rule::in(['startup', 'company', 'ngo', 'government']),
            ],

            'registration_number' => ['nullable', 'string', 'max:100'],

            'tax_id' => ['nullable', 'string', 'max:100'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('organizations', 'email'),
            ],

            'phone' => ['nullable', 'string', 'max:30'],

            'address' => ['nullable', 'string', 'max:255'],

            'city' => ['nullable', 'string', 'max:100'],

            'country' => ['nullable', 'string', 'max:100'],

            'timezone' => ['nullable', 'string', 'timezone'],

            'locale' => [
                'required',
                'string',
                Rule::in(['en', 'fr', 'es', 'de']),
            ],

            'plan' => [
                'required',
                'string',
                Rule::in(['free', 'basic', 'pro', 'enterprise']),
            ],

            'subscription_status' => [
                'required',
                'string',
                Rule::in(['active', 'inactive', 'canceled', 'trial']),
            ],

            'trial_ends_at' => ['nullable', 'date'],
        ];
    }
}
