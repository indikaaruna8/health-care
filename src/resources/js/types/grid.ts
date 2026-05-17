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

export interface TableColumn<T> {
    key: keyof T;
    label: string;
}
