import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        inertia(),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        // wayfinder({
        //     formVariants: true,
        // }),
    ],
    server: {
        host: '0.0.0.0', // Listen on all interfaces
        port: 5173,
        strictPort: true,
        // Enable HMR (Hot Module Replacement)
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
});
