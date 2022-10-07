const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');
const { default: flattenColorPalette } = require("tailwindcss/lib/util/flattenColorPalette");


/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  safelist: [
    // classes to always include in the build
    'animate-dropdown-open',
    'animate-dropdown-close'
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
      },
      animation: {
        'dropdown-open': 'dropdown-open 100ms ease-out forwards',
        'dropdown-close': 'dropdown-close 100ms ease-in forwards'
      },
      keyframes: {
        'dropdown-open': {
          from: {
            opacity: 0,
            transform: 'scale(0.95, 0.95)',
          },
          to: {
            opacity: 1,
            transform: 'scale(1, 1)',
          }
        },
        'dropdown-close': {
          from: {
            opacity: 1,
            transform: 'scale(1, 1)',
          },
          to: {
            opacity: 0,
            transform: 'scale(0.95, 0.95)',
          }
        }
      }
    },
  },
  plugins: [
    plugin(function ({ matchUtilities, theme }) {
      // registers the 'marker-rotating-COLOR' utility
      matchUtilities(
        {
          'marker-rotating': (value) => ({
            ['details>summary&::before']: {
              'border-color': `transparent transparent transparent ${value}`,
            },
          })
        },
        {
          type: 'color',
          values: flattenColorPalette(theme('colors'))
        }
      );
    }),
    require('@tailwindcss/forms'),
  ],
}
