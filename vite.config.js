import react from '@vitejs/plugin-react';
import laravel, { refreshPaths } from "laravel-vite-plugin";
import { defineConfig } from "vite";
import svgr from "vite-plugin-svgr";

export default defineConfig({
    server: {
        host: "localhost",
    },
    plugins: [
        laravel({
            input: [
                "resources/css/signature-pad.css",
                "resources/css/app.css",
                "resources/js/signature_pad.umd.js",
                "resources/js/sign.js",
                "resources/js/app.js",
                "resources/js/app.tsx",
            ],
            ssr: "resources/js/ssr.tsx",
            refresh: [
                ...refreshPaths,
                "app/Filament/**",
                "app/Forms/Components/**",
                "app/Livewire/**",
                "app/Infolists/Components/**",
                "app/Providers/Filament/**",
                "app/Tables/Columns/**",
            ],
        }),
        react(),
        svgr()
    ],
});
