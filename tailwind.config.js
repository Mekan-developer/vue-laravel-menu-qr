/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './resources/js/*.{js,jsx,ts,tsx}', 
        './resources/js/**/*.{js,jsx,ts,tsx}', 
        './resources/js/**/**/*.{js,jsx,ts,tsx}', 
        './public/index.html'
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
