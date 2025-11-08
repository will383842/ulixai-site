/**
 * Google Translate CSS Styles
 * Hides all Google Translate UI elements for a clean interface
 */

/**
 * Inject Google Translate styles into the document
 * These styles hide Google's default UI elements
 */
export function injectGoogleTranslateStyles() {
  const styleId = 'google-translate-styles';
  
  // Don't inject twice
  if (document.getElementById(styleId)) {
    console.log('ℹ️ [GoogleTranslate] Styles already injected');
    return;
  }

  console.log('🎨 [GoogleTranslate] Injecting styles...');

  const styles = `
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       🌐 GOOGLE TRANSLATE - HIDE UI ELEMENTS
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

    /* Hide top banner frame */
    iframe.goog-te-banner-frame,
    .goog-te-banner-frame {
      display: none !important;
    }

    /* Hide skiptranslate wrapper */
    body > .skiptranslate {
      display: none !important;
      height: 0 !important;
      overflow: hidden !important;
    }

    /* Reset Google's margin adjustments */
    html {
      margin-top: 0 !important;
    }

    body {
      top: 0 !important;
      position: static !important;
    }

    /* Hide inline toolbar and popup */
    .goog-te-gadget,
    #goog-gt-tt,
    .goog-te-balloon-frame {
      height: 0 !important;
      overflow: hidden !important;
      display: none !important;
      visibility: hidden !important;
      opacity: 0 !important;
    }

    /* Hide all Google Translate UI elements */
    .VIpgJd-ZVi9od-ORHb,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
    .VIpgJd-ZVi9od-ORHb-OEVmcd,
    .VIpgJd-ZVi9od-ORHb-hFsbo,
    .VIpgJd-ZVi9od-l4eHX-hSRGPd {
      display: none !important;
      visibility: hidden !important;
      opacity: 0 !important;
    }
  `;

  const styleElement = document.createElement('style');
  styleElement.id = styleId;
  styleElement.textContent = styles;
  document.head.appendChild(styleElement);
  
  console.log('✅ [GoogleTranslate] Styles injected');
}

/**
 * Remove Google Translate styles (for cleanup)
 */
export function removeGoogleTranslateStyles() {
  const styleElement = document.getElementById('google-translate-styles');
  if (styleElement) {
    styleElement.remove();
    console.log('🗑️ [GoogleTranslate] Styles removed');
  }
}