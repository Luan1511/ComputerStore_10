import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/tables.css',
                'resources/css/product.css',
                'resources/css/event.css',
                'resources/css/custom.css',
                'resources/css/compare.css',
                'resources/css/user.css',
                'resources/js/app.js',
                'resources/js/vendor/jquery-1.12.4.min.js',
            ],
            refresh: true,
            server: {
                hmr: {
                    host: "localhost",
                },
            },
        }),
    ],
});
