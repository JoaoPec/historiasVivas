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
            colors: {
                cream: '#FFF8E7',
                amber: {
                    DEFAULT: '#F5A623',
                    light: '#FFDEA3',
                    dark: '#D68C00'
                },
                teal: {
                    DEFAULT: '#2A7D6B',
                    light: '#3A9D89',
                    dark: '#1A5D4B'
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
