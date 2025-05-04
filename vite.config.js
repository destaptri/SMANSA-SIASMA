import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/css/alert.css',
                'resources/css/sidebar.css',
                'resources/css/styles.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/alert.js',
                'resources/js/bootstrap.js',
                'resources/js/filter.js',
                'resources/js/script.js',
                'resources/js/sidebar.js',
                'resources/images/account_circle.png',
                'resources/images/ava_demo.png',
                'resources/images/default_avatar.png',
                'resources/images/Frame 8.png',
                'resources/images/login_image.jpg',
                'resources/images/logo.png',
                'resources/images/new_releases.png',
                'resources/images/release_alert.png',
            ],
            refresh: true,
        }),
    ],
});
