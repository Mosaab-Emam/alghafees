import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';
import preset from './vendor/filament/support/tailwind.config.preset';

/** @type {import('tailwindcss').Config} */
export default {
    // presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
        './resources/css/**/*.css',
        './resources/js/**/*.{js,jsx,ts,tsx}',
    ],

    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    sm: "0rem",
                    lg: "0rem",
                    xl: "0rem",
                    "2xl": "1.5rem",
                },
            },
            fontFamily: {
                hacen: ['"Hacen Tunisia Bd"', "sans-serif"],
            },

            colors: {
                "bg-01": "#FEFFFF",
                "bg-02": "#F3F9FA",

                "Gray-scale-01": "#A8B2B5",
                "Gray-scale-02": "#51656A",
                "Gray-scale-03": "#808282",
                "Gray-scale-04": "#ECECEC",
                "Black-01": "#26292A",
                "Black-02": "#000000",

                // You can also use objects for color variations
                primary: {
                    100: "#E7F2F5",
                    200: "#CFE6EC",
                    300: "#9FCDD9",
                    400: "#6FB3C5",
                    500: "#3F9AB2",
                    600: "#0F819F",
                },
            },

            keyframes: {
                "custom-bounce": {
                    "0%, 100%": { transform: "translateY(4)" },
                    "50%": { transform: "translateY(-4px)" },
                },
            },
            animation: {
                "custom-bounce": "custom-bounce 2.5s ease-in-out infinite",
            },
        },
    },

    // plugins: [forms],
};