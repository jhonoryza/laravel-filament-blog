// import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    // presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
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
