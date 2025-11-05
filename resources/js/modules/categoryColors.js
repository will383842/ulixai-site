// Palette étendue de 80 couleurs uniques et distinctes visuellement
export const categoryColors = {
  // Palette principale : 80 couleurs variées et distinctes
  palette: [
    // Rouges (8)
    '#E74C3C', '#C0392B', '#E63946', '#D62828', '#F77F00', '#DC2F02', '#D00000', '#9D0208',
    
    // Oranges (8)
    '#E67E22', '#D35400', '#F39C12', '#F4A261', '#E76F51', '#EE6C4D', '#F08080', '#FF6B6B',
    
    // Jaunes (8)
    '#F1C40F', '#F39C12', '#FFB703', '#FFBA08', '#FBBF24', '#FCD34D', '#FDE047', '#FACC15',
    
    // Verts clairs (8)
    '#2ECC71', '#27AE60', '#16A085', '#06D6A0', '#10B981', '#14B8A6', '#22D3EE', '#06B6D4',
    
    // Verts foncés (8)
    '#1ABC9C', '#00B894', '#00D9A5', '#26DE81', '#20BF6B', '#118AB2', '#0D9488', '#059669',
    
    // Bleus clairs (8)
    '#3498DB', '#2980B9', '#0984E3', '#74B9FF', '#60A5FA', '#3B82F6', '#2563EB', '#4F46E5',
    
    // Bleus foncés (8)
    '#1E3A8A', '#1E40AF', '#1D4ED8', '#2563EB', '#0369A1', '#075985', '#0C4A6E', '#1F2937',
    
    // Violets (8)
    '#9B59B6', '#8E44AD', '#6C5CE7', '#A29BFE', '#7C3AED', '#6D28D9', '#5B21B6', '#4C1D95',
    
    // Roses (8)
    '#E91E63', '#D81B60', '#C2185B', '#FD79A8', '#F687B3', '#EC4899', '#DB2777', '#BE185D',
    
    // Bruns/Neutres (8)
    '#795548', '#6D4C41', '#5D4037', '#4E342E', '#78716C', '#57534E', '#44403C', '#292524'
  ]
};

/**
 * Génère un hash stable à partir d'un ID
 * Garantit que le même ID produit toujours le même hash
 */
function generateStableHash(id) {
  // Convertir l'ID en chaîne pour le traitement
  const str = String(id);
  let hash = 0;
  
  for (let i = 0; i < str.length; i++) {
    const char = str.charCodeAt(i);
    hash = ((hash << 5) - hash) + char;
    hash = hash & hash; // Convertir en entier 32bit
  }
  
  return Math.abs(hash);
}

/**
 * Convertit une couleur hex en RGB
 */
function hexToRgb(hex) {
  const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

/**
 * Convertit RGB en hex
 */
function rgbToHex(r, g, b) {
  return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase();
}

/**
 * Applique une variation à une couleur pour la rendre distincte
 * @param {string} color - Couleur hex de base
 * @param {number} variation - Niveau de variation (1-5)
 */
function applyColorVariation(color, variation) {
  const rgb = hexToRgb(color);
  if (!rgb) return color;
  
  // Appliquer des variations subtiles mais visibles
  const factor = variation * 15; // 15, 30, 45, 60, 75
  
  // Alterner entre éclaircir et assombrir
  const modifier = variation % 2 === 0 ? factor : -factor;
  
  const r = Math.max(0, Math.min(255, rgb.r + modifier));
  const g = Math.max(0, Math.min(255, rgb.g + modifier));
  const b = Math.max(0, Math.min(255, rgb.b + modifier));
  
  return rgbToHex(r, g, b);
}

/**
 * Calcule la distance de couleur entre deux couleurs (simplicité)
 */
function colorDistance(color1, color2) {
  const rgb1 = hexToRgb(color1);
  const rgb2 = hexToRgb(color2);
  
  if (!rgb1 || !rgb2) return 1000;
  
  return Math.sqrt(
    Math.pow(rgb1.r - rgb2.r, 2) +
    Math.pow(rgb1.g - rgb2.g, 2) +
    Math.pow(rgb1.b - rgb2.b, 2)
  );
}

/**
 * Obtient la couleur d'une catégorie basée sur son ID
 * @param {string} level - Le niveau de catégorie ('main', 'sub', 'child')
 * @param {number|string} id - L'ID unique de la catégorie
 * @param {Array} allIds - Tous les IDs à afficher sur la page actuelle
 * @returns {string} Code couleur hexadécimal
 */
export function getCategoryColor(level, id, allIds = []) {
  const colors = categoryColors.palette;
  
  // Générer un hash stable pour cet ID
  const hash = generateStableHash(id);
  const baseColorIndex = hash % colors.length;
  const baseColor = colors[baseColorIndex];
  
  // Si on n'a pas la liste complète, retourner la couleur de base
  if (allIds.length === 0) {
    return baseColor;
  }
  
  // Créer un mapping de tous les IDs vers leurs couleurs de base
  const colorMapping = new Map();
  const colorUsageCount = new Map();
  
  allIds.forEach(itemId => {
    const itemHash = generateStableHash(itemId);
    const itemColorIndex = itemHash % colors.length;
    const itemBaseColor = colors[itemColorIndex];
    
    colorMapping.set(itemId, itemBaseColor);
    
    // Compter combien de fois chaque couleur est utilisée
    const count = colorUsageCount.get(itemBaseColor) || 0;
    colorUsageCount.set(itemBaseColor, count + 1);
  });
  
  // Si la couleur de base n'est utilisée qu'une fois, la retourner telle quelle
  if (colorUsageCount.get(baseColor) === 1) {
    return baseColor;
  }
  
  // Si plusieurs catégories ont la même couleur de base, appliquer des variations
  const idsWithSameColor = allIds.filter(itemId => colorMapping.get(itemId) === baseColor);
  const indexInGroup = idsWithSameColor.indexOf(id);
  
  // Appliquer une variation si ce n'est pas le premier de la couleur
  if (indexInGroup > 0) {
    return applyColorVariation(baseColor, indexInGroup);
  }
  
  return baseColor;
}

/**
 * Obtient une couleur pour un niveau spécifique (pour compatibilité)
 * Applique une légère teinte selon le niveau pour différencier visuellement
 */
export function getCategoryColorByLevel(level, id, allIds = []) {
  const baseColor = getCategoryColor(level, id, allIds);
  const rgb = hexToRgb(baseColor);
  
  if (!rgb) return baseColor;
  
  // Appliquer une légère modification selon le niveau
  let r = rgb.r, g = rgb.g, b = rgb.b;
  
  switch(level) {
    case 'main':
      // Catégories principales : couleurs plus saturées
      r = Math.min(255, r + 10);
      g = Math.min(255, g + 10);
      b = Math.min(255, b + 10);
      break;
    case 'sub':
      // Sous-catégories : couleurs moyennes (pas de modification)
      break;
    case 'child':
      // Sous-sous-catégories : couleurs légèrement plus sombres
      r = Math.max(0, r - 15);
      g = Math.max(0, g - 15);
      b = Math.max(0, b - 15);
      break;
  }
  
  return rgbToHex(r, g, b);
}

// Configuration des niveaux de catégories
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

/**
 * Fonction de test pour vérifier le système de couleurs
 */
export function testColorSystem() {
  console.log('=== TEST DU SYSTÈME DE COULEURS ===');
  console.log(`Nombre de couleurs disponibles: ${categoryColors.palette.length}`);
  
  // Tester avec des IDs typiques
  const testIds = [1, 2, 3, 50, 100, 150, 200, 250, 300, 350, 400];
  
  console.log('\n--- Couleurs de base (sans doublons) ---');
  testIds.forEach(id => {
    const color = getCategoryColor('main', id, []);
    console.log(`ID ${id} → ${color}`);
  });
  
  // Tester avec des IDs qui pourraient avoir la même couleur
  const conflictIds = [1, 81, 161, 241]; // Ces IDs auront la même couleur de base
  
  console.log('\n--- Gestion des doublons ---');
  conflictIds.forEach(id => {
    const color = getCategoryColor('main', id, conflictIds);
    console.log(`ID ${id} → ${color} (avec variations)`);
  });
  
  console.log('\n--- Stabilité (même ID = même couleur) ---');
  const stableId = 42;
  for (let i = 0; i < 5; i++) {
    const color = getCategoryColor('main', stableId, []);
    console.log(`Appel ${i+1}: ID ${stableId} → ${color}`);
  }
}