/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {
      colors: {
        orange: {
          light: '#d05c33',
          DEFAULT: '#bb471e',
          dark: '#a13711',
        }
      }
    }
  },
  darkMode: false,
  plugins: [require("daisyui")],
  daisyui: { themes: ["light"] },
}

