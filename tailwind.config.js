import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        "./app/helpers.php",
        "./app/Livewire/**/*.php",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./resources/views/livewire/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                quicksand: ["Quicksand"],
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
    ],
};
