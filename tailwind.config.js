/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {},
  },
  darkMode: false,
  plugins: [require("daisyui")],
  daisyui: { themes: ["light"] },
}

