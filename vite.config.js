import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/common.ts',

                'resources/js/jobApplication.ts',
                'resources/js/jobAdverts.ts'
            ],
            refresh: true,
        }),
    ],
});
