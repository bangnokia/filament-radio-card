const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
  ],
  darkMode: 'class',
  corePlugins: {
    preflight: false,
  },
  theme: {
    extend: {
      colors: {
        danger: colors.rose,
        primary: colors.yellow,
        success: colors.green,
        warning: colors.amber,
      },
    },
  },
  plugins: [],
}

