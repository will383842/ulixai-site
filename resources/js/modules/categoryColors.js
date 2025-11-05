// Color palette with 25 colors for different category levels
export const categoryColors = {
  // Level 1: Main categories (vibrant and saturated colors)
  main: [
    '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', 
    '#9B59B6', '#E67E22', '#1ABC9C', '#E91E63',
    '#2980B9', '#27AE60', '#F1C40F', '#8E44AD',
    '#D35400', '#16A085', '#C0392B', '#2C3E50',
    '#D63031', '#0984E3', '#00B894', '#FDCB6E',
    '#6C5CE7', '#FD79A8', '#00CEC9', '#FF7675',
    '#74B9FF'
  ],
  
  // Level 2: Subcategories (medium saturated colors)
  sub: [
    '#FF7979', '#74B9FF', '#55EFC4', '#FFA502',
    '#A29BFE', '#FF6348', '#48DBFB', '#FF6B81',
    '#5F27CD', '#01A3A4', '#FECA57', '#EE5A6F',
    '#C44569', '#4834DF', '#26DE81', '#FDA7DF',
    '#F8B500', '#10AC84', '#EE5A24', '#576574',
    '#FA8231', '#20BF6B', '#778BEB', '#F8A5C2',
    '#EA8685'
  ],
  
  // Level 3: Sub-subcategories (darker colors)
  child: [
    '#FF8A9A', '#8FC7FF', '#6FECCD', '#FFB65E',
    '#C4A5FF', '#FFB3C1', '#70D9F0', '#FF9AB0',
    '#B8A5E0', '#55D4E8', '#FFE185', '#FFA8A8',
    '#E2B3DC', '#88E5CD', '#FFCFB3', '#B5DBF5',
    '#FFDB70', '#BF9ADB', '#98D9E5', '#FFC1D9',
    '#B5E4FF', '#FFD685', '#A8E7E9', '#FFB8C8',
    '#CDB0FF'
  ]
};

export function getCategoryColor(level, index) {
  if (!categoryColors[level]) {
    level = 'main';
  }
  const colors = categoryColors[level];
  return colors[index % colors.length];
}

export const categoryLevels = {
  main: {
    name: 'Main Categories',
    shadowColor: 'rgba(59, 130, 246, 0.15)',
    containerClass: 'main-categories',
    popupId: 'searchPopup'
  },
  sub: {
    name: 'Subcategories',
    shadowColor: 'rgba(16, 185, 129, 0.15)',
    containerClass: 'sub-category',
    popupId: 'expatriesPopup'
  },
  child: {
    name: 'Specific Needs',
    shadowColor: 'rgba(251, 146, 60, 0.15)',
    containerClass: 'child-categories',
    popupId: 'vacanciersAutresBesoinsPopup'
  }
};