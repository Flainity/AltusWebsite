/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./assets/**/*.vue",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      gridTemplateColumns: {
        '16': 'repeat(16, minmax(0, 1fr))',
      },
      maxHeight: {
        'px-80': '80px',
      },
      scale: {
        '102': '1.02',
      },
      borderWidth: {
        '1': '1px',
        '3': '3px',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

