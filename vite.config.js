import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Adjust this if your main CSS file is different
                'resources/js/app.js',    // Adjust this if your main JS file is different
            ],
            refresh: true,
        }),
    ],
});
