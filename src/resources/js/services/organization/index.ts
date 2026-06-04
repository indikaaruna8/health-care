import axios from 'axios';
import organizationsApi from '@/routes/organizations';
import type { ApiResponse } from '@/types/grid';
import type { Organization } from '@/types/organization';

export const organizationService = {
    async create(data: Organization): Promise<Organization> {
        const route = organizationsApi.store();
        const response = await axios({
            method: route.method,
            url: route.url,
            data,
        });

        return response.data;
    },
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
