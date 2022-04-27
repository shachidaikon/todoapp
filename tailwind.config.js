const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'clear-water': '#d9eaec',
                'fine-weed': '#74a64c',
                'baby-leaf': '#bcd537',
                'morning-wing': '#cae5d3',
                'clear-rain': '#dfe2ea',
                'refresh-blue': '#9cc9e5',
                'cream-blue': '#e0f1f1',
                'north-ocean': '#5188b1',
                'shine-muscat': '#aed265',
                'secondary': '#aed265',
            },
            keyframes: {
                'fade-in-down': {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(-10px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    },
                },
                'fade-out-down': {
                    'from': {
                        opacity: '1',
                        transform: 'translateY(0px)'
                    },
                    'to': {
                        opacity: '0',
                        transform: 'translateY(10px)'
                    },
                },
                'fade-in-up': {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(10px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    },
                },
                'fade-out-up': {
                    'from': {
                        opacity: '1',
                        transform: 'translateY(0px)'
                    },
                    'to': {
                        opacity: '0',
                        transform: 'translateY(10px)'
                    },
                }
            },
            animation: {
                'fade-in-down': 'fade-in-down 0.3s ease-out',
                'fade-out-down': 'fade-out-down 0.3s ease-out',
                'fade-in-up': 'fade-in-up 0.3s ease-out',
                'fade-out-up': 'fade-out-up 0.3s ease-out'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('daisyui')],
};
