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

export interface Pagination {
    current_page: number;
    per_page: number;
    total: number;
    last_page: number;
    from: number;
    to: number;
    has_more_pages: boolean;
    next_page_url: string | null;
    previous_page_url: string | null;
}

export interface ApiResponse<T> {
    success: boolean;
    data: T[];
    meta: {
        pagination: Pagination;
    };
}

export interface TableColumn {
    key: keyof Organization;
    label: string;
}
