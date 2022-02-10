module.exports = {
  mode: 'jit',
  content: ["**/*.php", "../../**/*.php"],
  theme: {
    container: {
      center: true,
      padding: '1.5rem',
    },
    extend: {
      colors: {
        'primary': '#BF020D',
        'theme-color': '#464644',
        'light-gray': '#EAEAEA',
      },
      spacing: {
        '26': '6.5rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
