const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        /* LIGHT THEME */
        'l-bgr-main': '#F2F5FF', // main background
        'l-bgr-content': '#e7eef1', // content background
        'l-bgr-highlight': '#6D52B7', // highlight background
        'l-brd': colors.slate['900'],
      }
    },
  },
  plugins: [],
}
