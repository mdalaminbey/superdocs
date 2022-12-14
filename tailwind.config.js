/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{php,js}"],
  theme: {
    extend: {
      colors: {
        'primary': '#4f46e5',
        'primary-hover': '#4338ca',
        'success': '#10b981',
        'success-hover': '#059669',
      },
      fontFamily: {
        'primary': ['Poppins']
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
  
}
