import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        "grid-cols-1",
        "grid-cols-2",
        "grid-cols-3",
        "grid-cols-4",
        "sm:grid-cols-2",
        "md:grid-cols-3",
        "lg:grid-cols-4",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#FF7A00",
                dark: "#0B0B0B",
                soft: "#F7F7F7",
            },
            borderRadius: {
                xl: "16px",
                "2xl": "20px",
            },
        },
    },

    plugins: [forms],
};
