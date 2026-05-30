import axios from 'axios';
import type { ApiResponse } from '@/types/grid';
import type { Organization } from '@/types/organization';

export const organizationService = {
    async search(
        search: string,
        page: number,
        filters: Record<string, string> = {},
    ): Promise<ApiResponse<Organization>> {
        const response = await axios.get<ApiResponse<Organization>>(
            '/organizations/search',
            {
                params: {
                    search,
                    page,
                    ...filters,
                },
            },
        );

        return response.data;
    },
};
