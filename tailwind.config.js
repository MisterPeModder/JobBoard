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
        'l-brd': colors.slate['900'], // border color

        'highlight': {
          light: '#8b76c4',
          DEFAULT: '#6D52B7' // main highlight color
        }
      }
    },
  },
  plugins: [],
}
