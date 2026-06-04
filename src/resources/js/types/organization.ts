export interface Organization {
    id: number;
    name: string;
    slug: string;
    type: string;
    registration_number: string;
    tax_id: string;
    email: string;
    phone: string;
    address: string;
    city: string;
    country: string;
    plan: string;
    subscription_status: string;
    subscription_status_text: string;
    trial_ends_at: string | null;
    logo: string | null;
    timezone: string;
    locale: string;
    owner_id: number;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
    trial_days_remaining?: number;
}

export interface ValidationErrorResponse {
    message: string;
    errors: Record<string, string[]>;
}
