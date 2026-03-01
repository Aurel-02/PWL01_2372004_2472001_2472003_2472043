import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#2E4365',     // Police Blue
                'secondary': '#E59D2C',   // Marigold
                'accent': '#8A3B08',      // Citrine Brown
                'pearl': '#EBDDC5',       // Pearl
                'buff': '#F3D58D',        // Buff
            },
        },
    },

    plugins: [forms],
};
