import preset from './vendor/filament/support/tailwind.config.preset'
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    presets: [preset],
    content: [
        "./app/helpers.php",
        "./app/Livewire/**/*.php",
        "./app/Filament/**/*.php",
        "./app/CommonMark/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./resources/views/livewire/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",

        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                main: ['Rubik', ...defaultTheme.fontFamily.sans],
                rubik: ['Rubik', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '100': '100',
            },
            colors: {
                "primary": "#333333",
                "secondary": "#b0b0b0",
                "link": "#377fab",
                "link-hover": "#1f6793"
            },
            listStyleType: {
                square: 'square',
                roman: 'upper-roman',
            }
        },
    },
    plugins: [
        forms,
        typography,
    ],
};
