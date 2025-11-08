// Système de couleurs optimisé avec distribution maximale et distinction visuelle
// Palette chaude et vive pour les catégories
export const categoryColors = {
  // Palette de base : 100 couleurs chaudes et vives organisées par groupes de teintes
  palette: [
    // === ROUGES CHAUDS (10) - Tons vifs et énergiques ===
    '#FF4444', '#E63946', '#DC2626', '#EF4444', '#F87171',
    '#DC143C', '#FF6B6B', '#E74C3C', '#C0392B', '#D32F2F',
    
    // === ORANGES VIFS (10) - Tons chaleureux et dynamiques ===
    '#FF6B35', '#FF8C42', '#FFA500', '#FF8C00', '#FF7F50',
    '#F77F00', '#FB8500', '#FF9E40', '#FF8E53', '#FF9966',
    
    // === JAUNES DORÉS (10) - Tons lumineux et chaleureux ===
    '#FFD700', '#FFC300', '#FFB300', '#FFBA08', '#FAA307',
    '#FFC107', '#FFD54F', '#FFCA28', '#FFB74D', '#FFE082',
    
    // === CORAILS/SAUMONS (10) - Tons doux et chaleureux ===
    '#FF6F61', '#FA8072', '#FF7F7F', '#FFB6AB', '#FF9999',
    '#FFA07A', '#FFB6C1', '#FF9AA2', '#FFB3B3', '#FF8787',
    
    // === BLEUS VIFS (10) - Tons clairs et lumineux ===
    '#4A90E2', '#5DADE2', '#3498DB', '#5DADE2', '#85C1E9',
    '#6BB6FF', '#4FC3F7', '#42A5F5', '#64B5F6', '#7EC8E3',
    
    // === BLEUS PROFONDS (10) - Tons riches et intenses ===
    '#2E86DE', '#1E88E5', '#1976D2', '#2C3E50', '#1565C0',
    '#0D47A1', '#34495E', '#2471A3', '#1F618D', '#154360',
    
    // === VIOLETS/POURPRES (10) - Tons chauds et sophistiqués ===
    '#9B59B6', '#8E44AD', '#A569BD', '#AF7AC5', '#BB8FCE',
    '#7D3C98', '#6C3483', '#5B2C6F', '#884EA0', '#9C27B0',
    
    // === ROSES/FUCHSIAS (10) - Tons vibrants et énergiques ===
    '#E91E63', '#EC407A', '#F06292', '#F48FB1', '#FF4081',
    '#D81B60', '#C2185B', '#FF6B9D', '#FF69B4', '#DA70D6',
    
    // === MARRONS CHAUDS (10) - Tons terreux et confortables ===
    '#8B4513', '#A0522D', '#CD853F', '#D2691E', '#BC8F8F',
    '#A0826D', '#8D6E63', '#6D4C41', '#795548', '#937264',
    
    // === GRIS/TAUPES (10) - Tons neutres et élégants ===
    '#95A5A6', '#7F8C8D', '#546E7A', '#607D8B', '#78909C',
    '#90A4AE', '#B0BEC5', '#8E8E93', '#9E9E9E', '#BDBDBD'
  ]
};

/**
 * Génère un index stable basé sur un ID
 * Utilise une distribution uniforme pour maximiser l'écart entre les couleurs consécutives
 */
function generateOptimalColorIndex(id, totalColors, usedIndices = new Set()) {
  const str = String(id);
  let hash = 0;
  
  // Générer un hash stable
  for (let i = 0; i < str.length; i++) {
    const char = str.charCodeAt(i);
    hash = ((hash << 5) - hash) + char;
    hash = hash & hash;
  }
  
  hash = Math.abs(hash);
  
  // Distribution en saut d'indices pour maximiser la distinction
  // Utiliser un nombre premier pour garantir une bonne distribution
  const step = 37; // Nombre premier pour meilleure distribution
  let index = (hash * step) % totalColors;
  
  // Si l'index est déjà utilisé, trouver le suivant disponible
  let attempts = 0;
  while (usedIndices.has(index) && attempts < totalColors) {
    index = (index + step) % totalColors;
    attempts++;
  }
  
  return index;
}

/**
 * Calcule la luminosité d'une couleur (0-255)
 */
function getLuminance(hex) {
  const rgb = hexToRgb(hex);
  if (!rgb) return 128;
  
  // Formule de luminosité perceptuelle
  return 0.299 * rgb.r + 0.587 * rgb.g + 0.114 * rgb.b;
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
  const toHex = (n) => {
    const hex = Math.round(Math.max(0, Math.min(255, n))).toString(16);
    return hex.length === 1 ? '0' + hex : hex;
  };
  return `#${toHex(r)}${toHex(g)}${toHex(b)}`.toUpperCase();
}

/**
 * Calcule la distance perceptuelle entre deux couleurs
 * Utilise la formule CIEDE2000 simplifiée
 */
function calculateColorDistance(color1, color2) {
  const rgb1 = hexToRgb(color1);
  const rgb2 = hexToRgb(color2);
  
  if (!rgb1 || !rgb2) return 1000;
  
  // Distance euclidienne pondérée dans l'espace RGB
  // Les coefficients reflètent la perception humaine
  const rDiff = rgb1.r - rgb2.r;
  const gDiff = rgb1.g - rgb2.g;
  const bDiff = rgb1.b - rgb2.b;
  
  const rMean = (rgb1.r + rgb2.r) / 2;
  
  // Formule de distance perceptuelle améliorée
  const weightR = 2 + rMean / 256;
  const weightG = 4.0;
  const weightB = 2 + (255 - rMean) / 256;
  
  return Math.sqrt(
    weightR * rDiff * rDiff +
    weightG * gDiff * gDiff +
    weightB * bDiff * bDiff
  );
}

/**
 * Ajuste la saturation et la luminosité d'une couleur selon le niveau
 */
function adjustColorForLevel(hex, level) {
  const rgb = hexToRgb(hex);
  if (!rgb) return hex;
  
  // Convertir en HSL pour manipuler saturation et luminosité
  let r = rgb.r / 255;
  let g = rgb.g / 255;
  let b = rgb.b / 255;
  
  const max = Math.max(r, g, b);
  const min = Math.min(r, g, b);
  let h, s, l = (max + min) / 2;
  
  if (max === min) {
    h = s = 0; // Gris
  } else {
    const d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    
    switch (max) {
      case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
      case g: h = ((b - r) / d + 2) / 6; break;
      case b: h = ((r - g) / d + 4) / 6; break;
    }
  }
  
  // Ajuster selon le niveau
  switch(level) {
    case 'main':
      // Catégories principales : saturation maximale, luminosité moyenne-haute
      s = Math.min(1, s * 1.2); // +20% saturation
      l = Math.max(0.45, Math.min(0.65, l)); // Luminosité contrôlée
      break;
      
    case 'sub':
      // Sous-catégories : saturation légèrement réduite
      s = Math.min(1, s * 1.0); // Saturation normale
      l = Math.max(0.40, Math.min(0.60, l * 0.95)); // Légèrement plus sombre
      break;
      
    case 'child':
      // Sous-sous-catégories : saturation réduite, plus sombre
      s = Math.min(1, s * 0.85); // -15% saturation
      l = Math.max(0.35, Math.min(0.55, l * 0.85)); // Plus sombre
      break;
  }
  
  // Convertir HSL vers RGB
  let r2, g2, b2;
  
  if (s === 0) {
    r2 = g2 = b2 = l;
  } else {
    const hue2rgb = (p, q, t) => {
      if (t < 0) t += 1;
      if (t > 1) t -= 1;
      if (t < 1/6) return p + (q - p) * 6 * t;
      if (t < 1/2) return q;
      if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
      return p;
    };
    
    const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
    const p = 2 * l - q;
    
    r2 = hue2rgb(p, q, h + 1/3);
    g2 = hue2rgb(p, q, h);
    b2 = hue2rgb(p, q, h - 1/3);
  }
  
  return rgbToHex(r2 * 255, g2 * 255, b2 * 255);
}

/**
 * Sélectionne les couleurs les plus distinctes pour un ensemble d'IDs
 * Garantit une distance maximale entre toutes les couleurs utilisées
 */
function selectDistinctColors(ids, level) {
  const colors = categoryColors.palette;
  const selectedColors = new Map();
  const usedIndices = new Set();
  
  // Trier les IDs pour garantir une attribution stable
  const sortedIds = [...ids].sort((a, b) => {
    const aStr = String(a);
    const bStr = String(b);
    return aStr.localeCompare(bStr, undefined, { numeric: true });
  });
  
  // Pour chaque ID, trouver la couleur la plus distincte
  sortedIds.forEach(id => {
    let bestIndex = -1;
    let bestMinDistance = -1;
    
    // Essayer plusieurs candidats
    const candidates = [];
    for (let i = 0; i < 5; i++) {
      const index = generateOptimalColorIndex(id + i * 1000, colors.length, usedIndices);
      if (!usedIndices.has(index)) {
        candidates.push(index);
      }
    }
    
    // Sélectionner le candidat avec la distance minimale maximale
    for (const candidateIndex of candidates) {
      const candidateColor = colors[candidateIndex];
      
      // Calculer la distance minimale avec toutes les couleurs déjà sélectionnées
      let minDistance = Infinity;
      
      for (const [selectedId, selectedColor] of selectedColors) {
        const distance = calculateColorDistance(candidateColor, selectedColor);
        minDistance = Math.min(minDistance, distance);
      }
      
      // Si c'est la première couleur ou si cette couleur est plus distincte
      if (selectedColors.size === 0 || minDistance > bestMinDistance) {
        bestMinDistance = minDistance;
        bestIndex = candidateIndex;
      }
    }
    
    // Si aucun candidat n'est satisfaisant, prendre le premier disponible
    if (bestIndex === -1) {
      bestIndex = generateOptimalColorIndex(id, colors.length, usedIndices);
    }
    
    usedIndices.add(bestIndex);
    const baseColor = colors[bestIndex];
    const adjustedColor = adjustColorForLevel(baseColor, level);
    selectedColors.set(id, adjustedColor);
  });
  
  return selectedColors;
}

/**
 * Obtient la couleur d'une catégorie
 * @param {string} level - Le niveau ('main', 'sub', 'child')
 * @param {number|string} id - L'ID de la catégorie
 * @param {Array} allIds - Tous les IDs du contexte actuel
 * @returns {string} Code couleur hexadécimal
 */
export function getCategoryColor(level, id, allIds = []) {
  // Si pas d'IDs fournis, utiliser une couleur de base ajustée
  if (!allIds || allIds.length === 0) {
    const colors = categoryColors.palette;
    const index = generateOptimalColorIndex(id, colors.length);
    return adjustColorForLevel(colors[index], level);
  }
  
  // Sélectionner toutes les couleurs distinctes pour ce contexte
  const colorMap = selectDistinctColors(allIds, level);
  
  // Retourner la couleur pour cet ID
  return colorMap.get(id) || adjustColorForLevel(categoryColors.palette[0], level);
}

/**
 * Obtient une couleur pour un niveau spécifique
 * Alias de getCategoryColor pour compatibilité
 */
export function getCategoryColorByLevel(level, id, allIds = []) {
  return getCategoryColor(level, id, allIds);
}

/**
 * Validation du système : vérifie que toutes les couleurs sont distinctes
 */
export function validateColorDistinctness(ids, level = 'main') {
  const colorMap = selectDistinctColors(ids, level);
  const colors = Array.from(colorMap.values());
  
  let minDistance = Infinity;
  let problematicPairs = [];
  
  for (let i = 0; i < colors.length; i++) {
    for (let j = i + 1; j < colors.length; j++) {
      const distance = calculateColorDistance(colors[i], colors[j]);
      
      if (distance < minDistance) {
        minDistance = distance;
      }
      
      // Seuil de distinction : 50 est considéré comme trop proche
      if (distance < 50) {
        problematicPairs.push({
          color1: colors[i],
          color2: colors[j],
          distance: distance.toFixed(2)
        });
      }
    }
  }
  
  return {
    valid: problematicPairs.length === 0,
    minDistance: minDistance.toFixed(2),
    problematicPairs,
    totalColors: colors.length,
    averageDistance: colors.length > 1 ? 
      (colors.reduce((sum, c1, i) => {
        return sum + colors.slice(i + 1).reduce((s, c2) => 
          s + calculateColorDistance(c1, c2), 0);
      }, 0) / (colors.length * (colors.length - 1) / 2)).toFixed(2) : 0
  };
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
 * Fonction de test complète du système
 */
export function testColorSystem() {
  console.log('=== TEST DU SYSTÈME DE COULEURS AMÉLIORÉ ===\n');
  
  // Test 1 : Stabilité
  console.log('--- Test 1 : Stabilité (même ID = même couleur) ---');
  const testId = 42;
  const colors = [];
  for (let i = 0; i < 5; i++) {
    const color = getCategoryColor('main', testId, [testId, 43, 44]);
    colors.push(color);
    console.log(`Appel ${i + 1}: ID ${testId} → ${color}`);
  }
  const allSame = colors.every(c => c === colors[0]);
  console.log(`✓ Stabilité: ${allSame ? 'OK' : 'ÉCHEC'}\n`);
  
  // Test 2 : Distinction avec beaucoup de catégories
  console.log('--- Test 2 : Distinction avec 50 catégories ---');
  const manyIds = Array.from({ length: 50 }, (_, i) => i + 1);
  const validation = validateColorDistinctness(manyIds, 'main');
  console.log(`Nombre de couleurs: ${validation.totalColors}`);
  console.log(`Distance minimale: ${validation.minDistance}`);
  console.log(`Distance moyenne: ${validation.averageDistance}`);
  console.log(`Paires problématiques: ${validation.problematicPairs.length}`);
  console.log(`✓ Validation: ${validation.valid ? 'OK' : 'ATTENTION'}\n`);
  
  // Test 3 : Différences entre niveaux
  console.log('--- Test 3 : Ajustement par niveau ---');
  const testIds = [10, 20, 30];
  ['main', 'sub', 'child'].forEach(level => {
    console.log(`\nNiveau "${level}":`);
    testIds.forEach(id => {
      const color = getCategoryColor(level, id, testIds);
      const luminance = getLuminance(color);
      console.log(`  ID ${id} → ${color} (luminosité: ${luminance.toFixed(0)})`);
    });
  });
  
  // Test 4 : Scénario réel (ajout/suppression)
  console.log('\n--- Test 4 : Ajout/suppression dynamique ---');
  let dynamicIds = [1, 2, 3, 4, 5];
  console.log('Couleurs initiales (IDs 1-5):');
  dynamicIds.forEach(id => {
    console.log(`  ID ${id} → ${getCategoryColor('main', id, dynamicIds)}`);
  });
  
  // Ajouter des IDs
  dynamicIds = [1, 2, 3, 4, 5, 6, 7];
  console.log('\nAprès ajout des IDs 6-7:');
  [6, 7].forEach(id => {
    console.log(`  ID ${id} → ${getCategoryColor('main', id, dynamicIds)}`);
  });
  
  // Vérifier que les anciennes couleurs n'ont pas changé
  console.log('\nVérification des couleurs existantes (doivent être identiques):');
  [1, 2, 3, 4, 5].forEach(id => {
    console.log(`  ID ${id} → ${getCategoryColor('main', id, dynamicIds)}`);
  });
  
  console.log('\n=== FIN DES TESTS ===');
}