<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class SearchOrganizationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:startup,sme,enterprise,nonprofit',
            'plan' => 'nullable|string|in:free,basic,premium,enterprise',
            'subscription_status' => 'nullable|string|in:trial,active,expired,canceled',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'owner_id' => 'nullable|integer|exists:users,id',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
            'sort_by' => 'nullable|string|in:id,name,created_at,updated_at,plan',
            'sort_direction' => 'nullable|string|in:asc,desc',
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => 'Type must be: startup, sme, enterprise, or nonprofit',
            'plan.in' => 'Plan must be: free, basic, premium, or enterprise',
            'subscription_status.in' => 'Status must be: trial, active, expired, or canceled',
        ];
    }
}
