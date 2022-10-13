import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/common.css',
                'resources/js/common.ts',

                'resources/js/components/advertOptions.ts',
                'resources/js/components/exclusiveDetails.ts',
                'resources/js/components/hamburgerMenu.ts',
                'resources/js/components/imageInput.ts',
            ],
            refresh: true,
        }),
    ],
});
