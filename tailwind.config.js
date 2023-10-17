import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mona: ['Mona Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                phonska: {
                    '50': '#ebfef6',
                    '100': '#cefde8',
                    '200': '#a1f9d8',
                    '300': '#64f1c3',
                    '400': '#27e0ab',
                    '500': '#02c795',
                    '600': '#00a27a',
                    '700': '#008265',
                    '800': '#006651',
                    '900': '#004f40',
                    '950': '#003028',
                },
                secondary: {
                    '50': '#f4f9f8',
                    '100': '#daede9',
                    '200': '#add7cf',
                    '300': '#87c1b8',
                    '400': '#5ea39a',
                    '500': '#448880',
                    '600': '#356c67',
                    '700': '#2d5854',
                    '800': '#284745',
                    '900': '#243d3b',
                    '950': '#112222',
                },

            },
        },
    },

    plugins: [forms],
};
