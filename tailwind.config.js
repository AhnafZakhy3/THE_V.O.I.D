/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php"],
  theme: {
    extend: {
      colors: {
        'vanta': '#050505',
        'bone': '#F0F0F0',
        'ash': '#2A2A2A',
        'neon': '#FF2A00',
        'aura': '#4400FF',
      },
      fontFamily: {
        'display': ['Syne', 'sans-serif'],
        'serif': ['Cormorant Garamond', 'serif'],
        'mono': ['JetBrains Mono', 'monospace'],
      },
      animation: {
        'mesh-slow': 'mesh-slow 20s ease-in-out infinite alternate',
      },
      keyframes: {
        'mesh-slow': {
          '0%': { transform: 'rotate(0deg) scale(1)' },
          '100%': { transform: 'rotate(180deg) scale(1.5)' },
        }
      }
    },
  },
  plugins: [],
}
