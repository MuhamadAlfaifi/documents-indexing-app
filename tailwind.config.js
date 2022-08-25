const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['sf-arabic', 'arial', 'sans-serift'],
            },
            backgroundPosition: {
                'caret': 'left 0.5rem center'
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'), 
        plugin(function asterisk({ addComponents }) {
            addComponents({
                '.asterisk': {
                    position: 'relative',
                    '&::after': {
                        content: '" *"',
                        top: 0,
                        left: -10,
                        color: '#f00',
                    },
                },
            });
        }),
    ],
};