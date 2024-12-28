import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                papayawhip: {
                    light: "#fef4e4",
                    DEFAULT: "#ffefd5",
                    dark: "#fee5bc",
                },
            },
            screens: {
                widescreen: { raw: "(min-aspect-ratio: 3/2)" },
                tallscreen: { raw: "(max-aspect-ratio: 13/20)" },
            },
            keyframes: {
                "open-menu": {
                    "0%": { transform: "scaleY(0)" },
                    "80%": { transform: "scaleY(1.2)" },
                    "100%": { transform: "scaleY(1)" },
                },
            },
            animation: {
                "open-menu": "open-menu 0.5s ease-in-out forwards",
            },
        },
    },
    plugins: [],
};
