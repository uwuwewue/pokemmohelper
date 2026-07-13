import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/shiny-create.js',
                'resources/js/pokedex.js',
                'resources/js/profile.js',
            ],
            refresh: true,
        }),
    ],
});
