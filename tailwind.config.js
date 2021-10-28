const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                'modal-background': 'rgba( 17, 34, 60, .6)',

                'astronaut': {
                    50: '#F3F5F8',
                    100: '#E8EBF1',
                    200: '#C5CDDB',
                    300: '#A2AEC5',
                    400: '#5C729A',
                    500: '#16356E',
                    600: '#143063',
                    700: '#0D2042',
                    800: '#0A1832',
                    900: '#071021',
                }, 
            
                'golden-grass': {
                    50: '#FDFAF4',
                    100: '#FBF6EA',
                    200: '#F4E8C9',
                    300: '#EDDBA9',
                    400: '#E0BF69',
                    500: '#D3A428',
                    600: '#BE9424',
                    700: '#7F6218',
                    800: '#5F4A12',
                    900: '#3F310C',
                }, 
            
                'himalaya': {
                    50: '#F7F7F4',
                    100: '#F0EFE8',
                    200: '#D8D6C6',
                    300: '#C1BDA4',
                    400: '#938C5F',
                    500: '#645A1B',
                    600: '#5A5118',
                    700: '#3C3610',
                    800: '#2D290C',
                    900: '#1E1B08',
                }
            },
            
            
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },

            zIndex: {
                'modal': 9999999,
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
};
