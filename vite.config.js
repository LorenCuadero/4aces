import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';
import vue from '@vitejs/plugin-vue';

dotenv.config();

const viteConfig = {
    plugins: [
        vue(),
        laravel({
            input:[],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: process.env.VITE_SERVE_PORT,
    },
};

if (process.env.VITE_LOCAL_IP) {
    viteConfig.server.hmr = {
        host: process.env.VITE_LOCAL_IP,
        clientPort: process.env.VITE_SERVE_PORT,
    };
}

export default defineConfig(viteConfig);
