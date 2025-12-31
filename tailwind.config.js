module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/**/*.html",
  ],
  safelist: [
    // ═══════════════════════════════════════════════════════════
    // PATTERNS - Pour inclure toutes les variantes de couleurs
    // ═══════════════════════════════════════════════════════════
    {
      pattern: /bg-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo|slate|zinc|neutral|stone|amber|lime|teal|sky|violet|fuchsia|rose)-(50|100|200|300|400|500|600|700|800|900|950)/,
      variants: ['hover', 'focus', 'active', 'group-hover'],
    },
    {
      pattern: /text-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo|slate|zinc|neutral|stone|amber|lime|teal|sky|violet|fuchsia|rose)-(50|100|200|300|400|500|600|700|800|900|950)/,
      variants: ['hover', 'focus', 'active', 'group-hover'],
    },
    {
      pattern: /border-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo|slate|zinc|neutral|stone|amber|lime|teal|sky|violet|fuchsia|rose)-(50|100|200|300|400|500|600|700|800|900|950)/,
      variants: ['hover', 'focus', 'active', 'group-hover'],
    },
    {
      pattern: /from-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo|slate|zinc|neutral|stone|amber|lime|teal|sky|violet|fuchsia|rose)-(50|100|200|300|400|500|600|700|800|900|950)/,
      variants: ['hover'],
    },
    {
      pattern: /to-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo|slate|zinc|neutral|stone|amber|lime|teal|sky|violet|fuchsia|rose)-(50|100|200|300|400|500|600|700|800|900|950)/,
      variants: ['hover'],
    },
    {
      pattern: /via-(blue|red|purple|gray|white|black|emerald|orange|cyan|green|yellow|pink|indigo)-(50|100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /ring-(blue|red|purple|gray|emerald|orange)-(50|100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /shadow-(sm|md|lg|xl|2xl|none)/,
      variants: ['hover'],
    },
    {
      pattern: /rounded-(none|sm|md|lg|xl|2xl|3xl|full)/,
    },
    {
      pattern: /opacity-(0|5|10|20|25|30|40|50|60|70|75|80|90|95|100)/,
      variants: ['hover', 'group-hover'],
    },
    {
      pattern: /scale-(0|50|75|90|95|100|105|110|125|150)/,
      variants: ['hover', 'group-hover'],
    },
    {
      pattern: /translate-(x|y)-(0|1|2|3|4|5|6|8|10|12|16|20|24|full)/,
      variants: ['hover', 'group-hover'],
    },
    {
      pattern: /z-(0|10|20|30|40|50)/,
    },

    // ═══════════════════════════════════════════════════════════
    // CLASSES EXPLICITES - Header, Footer, Navigation
    // ═══════════════════════════════════════════════════════════

    // Layout & Display
    'flex', 'inline-flex', 'block', 'inline-block', 'hidden', 'grid',
    'flex-col', 'flex-row', 'flex-wrap', 'flex-1', 'flex-shrink-0',
    'items-center', 'items-start', 'items-end',
    'justify-center', 'justify-between', 'justify-start', 'justify-end',
    'fixed', 'absolute', 'relative', 'sticky',
    'top-0', 'left-0', 'right-0', 'bottom-0', 'inset-0',
    'overflow-hidden', 'overflow-x-hidden', 'overflow-y-auto',

    // Spacing
    'p-2', 'p-3', 'p-4', 'p-5', 'p-6', 'p-8',
    'px-2', 'px-3', 'px-4', 'px-5', 'px-6', 'px-8', 'px-2.5',
    'py-1', 'py-2', 'py-3', 'py-4', 'py-5', 'py-6', 'py-0.5', 'py-2.5', 'py-3.5',
    'pt-20', 'pt-4', 'pt-6', 'pb-4', 'pb-6', 'pb-8', 'pb-32',
    'm-0', 'mx-auto', 'my-2', 'my-4',
    'mt-1', 'mt-2', 'mt-4', 'mb-1', 'mb-2', 'mb-4', 'mb-6', 'mb-10',
    'space-x-2', 'space-x-3', 'space-x-4', 'space-x-2.5',
    'space-y-2', 'space-y-4',
    'gap-1', 'gap-2', 'gap-3', 'gap-4', 'gap-1.5', 'gap-2.5', 'gap-x-4', 'gap-y-4',

    // Sizing
    'w-4', 'w-5', 'w-6', 'w-7', 'w-8', 'w-9', 'w-10', 'w-11', 'w-12', 'w-32', 'w-52', 'w-64',
    'w-full', 'w-auto', 'min-w-0',
    'h-4', 'h-5', 'h-6', 'h-7', 'h-8', 'h-10', 'h-11', 'h-12', 'h-16', 'h-48',
    'h-full', 'h-auto', 'h-0.5', 'h-1.5', 'h-3.5',
    'max-w-7xl', 'max-w-5xl', 'max-w-3xl', 'max-w-xl', 'max-w-md',
    'max-h-14',

    // Typography
    'text-xs', 'text-sm', 'text-base', 'text-lg', 'text-xl', 'text-2xl', 'text-3xl', 'text-4xl', 'text-6xl',
    'font-medium', 'font-semibold', 'font-bold', 'font-black',
    'text-left', 'text-center', 'text-right',
    'leading-tight', 'leading-snug', 'leading-relaxed',
    'tracking-wider', 'uppercase', 'truncate', 'whitespace-nowrap',
    'text-white', 'text-black', 'text-transparent',

    // Background
    'bg-white', 'bg-black', 'bg-transparent',
    'bg-gradient-to-r', 'bg-gradient-to-br', 'bg-gradient-to-b', 'bg-gradient-to-t',
    'bg-clip-text', 'bg-center', 'bg-cover',
    'bg-white/20', 'bg-white/70', 'bg-black/40', 'bg-black/50',

    // Borders
    'border', 'border-2', 'border-t', 'border-b', 'border-l', 'border-r',
    'border-transparent', 'border-white',
    'border-blue-200/50',
    'rounded', 'rounded-lg', 'rounded-xl', 'rounded-2xl', 'rounded-3xl', 'rounded-full', 'rounded-md',
    'rounded-t-3xl', 'rounded-b-3xl',

    // Effects
    'shadow-sm', 'shadow', 'shadow-md', 'shadow-lg', 'shadow-xl', 'shadow-2xl',
    'blur', 'blur-3xl', 'backdrop-blur-sm',
    'ring-1',

    // Transitions & Animations
    'transition', 'transition-all', 'transition-colors', 'transition-opacity', 'transition-transform',
    'duration-150', 'duration-200', 'duration-300', 'duration-400',
    'ease-out', 'ease-in-out',
    'transform', 'translate-y-full',
    'animate-pulse', 'animate-spin',

    // Hover states
    'hover:bg-white', 'hover:bg-blue-50', 'hover:bg-gray-50', 'hover:bg-gray-100',
    'hover:bg-red-50', 'hover:bg-purple-50', 'hover:bg-orange-50',
    'hover:bg-blue-700',
    'hover:text-blue-600', 'hover:text-emerald-600', 'hover:text-orange-600', 'hover:text-purple-600',
    'hover:border-blue-200',
    'hover:shadow-sm', 'hover:shadow-md', 'hover:shadow-xl',
    'hover:scale-105', 'hover:scale-110',
    'hover:from-blue-50', 'hover:from-blue-100', 'hover:from-blue-700', 'hover:from-purple-100', 'hover:from-red-600',
    'hover:to-blue-100', 'hover:to-blue-800', 'hover:to-indigo-50', 'hover:to-indigo-100', 'hover:to-red-700',
    'hover:bg-gradient-to-r',
    'hover-glow',

    // Group hover
    'group', 'group-hover:opacity-50', 'group-hover:opacity-100',
    'group-hover:scale-110', 'group-hover:translate-x-1',
    'group-hover:text-blue-600', 'group-hover:text-gray-600',
    'group-hover:border-blue-200', 'group-hover:bg-white/30',

    // Focus states
    'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500',
    'focus-visible:ring-2', 'focus-visible:ring-blue-500',

    // Z-index
    'z-10', 'z-20', 'z-30', 'z-40', 'z-50',
    'z-[60]', 'z-[300]',

    // Grid
    'grid-cols-2', 'grid-cols-3', 'grid-cols-5',
    'grid-cols-[auto_1fr_auto]',
    'col-span-2',

    // Responsive - Small screens
    'sm:inline', 'sm:px-4', 'sm:px-6', 'sm:text-4xl',

    // Responsive - Large screens
    'lg:flex', 'lg:hidden', 'lg:flex-row',
    'lg:col-span-1', 'lg:grid-cols-5',
    'lg:p-6', 'lg:px-6', 'lg:px-8', 'lg:pt-20',
    'lg:text-base', 'lg:text-xl', 'lg:text-3xl', 'lg:text-6xl',
    'lg:w-auto',

    // Specific positions
    'top-[62px]', 'top-20',

    // Misc
    'antialiased', 'cursor-pointer',
    'object-contain',
    'min-h-screen',

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
