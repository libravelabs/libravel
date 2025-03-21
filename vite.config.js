import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: process.env.APP_URL,
        hmr: {
            protocol: "wss", //use 'wss' if your project is using https *libravel_ admin
            host: process.env.APP_URL,
            watch: {
                usePolling: true,
            },
        },
    },
});
