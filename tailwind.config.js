module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/**/*.html",
  ],
  safelist: [
    // ═══════════════════════════════════════════════════════════
    // Classes dynamiques utilisées via $role['cls'] et autres variables PHP
    // ═══════════════════════════════════════════════════════════

    // Role badges (utilisés dans navbar-desktop.blade.php et navbar-mobile.blade.php)
    'bg-blue-100', 'text-blue-700', 'bg-green-100', 'text-green-700',
    'bg-purple-100', 'text-purple-700', 'bg-orange-100', 'text-orange-700',
    'bg-red-100', 'text-red-700', 'bg-gray-100', 'text-gray-700',
    'bg-emerald-100', 'text-emerald-700', 'bg-indigo-100', 'text-indigo-700',

    // Conditional visibility
    'hidden', 'sm:col-span-2',

    // Z-index custom
    'z-[60]', 'z-[300]',

    // Custom position
    'top-[62px]',

    // Animations personnalisées
    'animate-glow',
  ],
  theme: {
    extend: {
      animation: {
        'glow': 'glow 2s ease-in-out infinite alternate',
      },
      keyframes: {
        glow: {
          '0%': { boxShadow: '0 0 5px rgba(239, 68, 68, 0.5), 0 0 10px rgba(239, 68, 68, 0.3)' },
          '100%': { boxShadow: '0 0 10px rgba(239, 68, 68, 0.8), 0 0 20px rgba(239, 68, 68, 0.5), 0 0 30px rgba(239, 68, 68, 0.3)' },
        },
      },
    },
  },
  plugins: [],
}
