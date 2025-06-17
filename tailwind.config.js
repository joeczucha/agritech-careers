import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Arial", "Helvetica Neue", "Helvetica", "sans-serif"],
            },
            colors: {
                slate: "#666666",
                blue: "#2f4d91",
                green: "#3d9c46",
            },
            container: {
                center: true,
                padding: "1rem",
                screens: {
                    lg: "1080px",
                },
            },
        },
    },
    plugins: [],
};
