import inertia from '@inertiajs/vite';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import fs from 'fs';

const vitePort = Number(process.env.VITE_PORT) || 5173;
const viteHost = process.env.VITE_HOST || '0.0.0.0';
const httpsEnabled = process.env.HTTPS_ENABLED === 'true';
const https = httpsEnabled ? {
    key: fs.readFileSync('/certs/localhost-key.pem'),
    cert: fs.readFileSync('/certs/localhost.pem'),
} : false;

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        inertia(),
        tailwindcss(),
        vue(),
    ],

    server: {
        host: viteHost,
        port: vitePort,
        strictPort: true,

        // HTTPS enabled
        https: https,

        // IMPORTANT FIX
        hmr: {
            protocol: httpsEnabled ? 'wss' : 'ws',   // 🔥 REQUIRED for HTTPS
            host: 'localhost', // or '127.0.0.1'
            port: vitePort,
        },
    },
});
