<!-- Step 4: Categories - ZERO SCROLL MOBILE-FIRST PERFECTION 🚀 -->
<!-- 200% Mobile-First | NO SCROLL | Lightning Fast | Categories + Subcategories Modal -->

<style>
/* === ZERO SCROLL MOBILE-FIRST FOUNDATION === */
#step4 {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
    width: 100%;
    height: 100%;
    max-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
    contain: layout style paint;
    padding: clamp(8px, 2vh, 16px);
    box-sizing: border-box;
    overflow: hidden;
    background: linear-gradient(135deg, 
        #3b82f6 0%, 
        #2563eb 25%, 
        #60a5fa 50%, 
        #3b82f6 75%, 
        #2563eb 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step4.hidden {
    display: none !important;
}

/* Header ultra-compact mobile-first */
#step4 .step4-header {
    text-align: center;
    margin-bottom: clamp(8px, 2vh, 12px);
    flex-shrink: 0;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Icon badge compact */
#step4 .step4-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(59, 130, 246, 0.7),
        0 4px 12px rgba(59, 130, 246, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step4 .step4-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

/* Titre compact */
#step4 .step4-title {
    font-size: clamp(16px, 4vw, 24px);
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #dbeafe 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
    line-height: 1.2;
    letter-spacing: -0.02em;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
}

/* Categories container - scrollable */
#step4 .step4-container {
    flex: 1;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(20px);
    border-radius: clamp(14px, 3.5vw, 20px);
    padding: clamp(10px, 2.5vh, 14px);
    margin-bottom: clamp(8px, 2vh, 12px);
    box-shadow: 
        0 6px 24px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.3);
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    min-height: 0;
}

#step4 .step4-container::-webkit-scrollbar {
    width: 4px;
}

#step4 .step4-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}

#step4 .step4-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
}

/* Categories grid */
#step4 .step4-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: clamp(8px, 2vw, 12px);
}

@media (min-width: 640px) {
    #step4 .step4-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Category card */
#step4 .step4-category {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: clamp(12px, 3vw, 16px);
    padding: clamp(12px, 3vh, 16px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: clamp(6px, 1.5vw, 10px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-height: clamp(80px, 18vw, 100px);
    text-align: center;
    -webkit-tap-highlight-color: transparent;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
}

#step4 .step4-category:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    border-color: rgba(59, 130, 246, 0.6);
}

#step4 .step4-category.selected {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border-color: #3b82f6;
    box-shadow: 
        0 6px 24px rgba(59, 130, 246, 0.6),
        0 0 0 4px rgba(59, 130, 246, 0.2);
    transform: translateY(-3px) scale(1.02);
}

#step4 .step4-category.selected .step4-category-name {
    color: white;
    font-weight: 800;
}

#step4 .step4-category-icon {
    width: clamp(28px, 6vw, 40px);
    height: clamp(28px, 6vw, 40px);
    display: flex;
    align-items: center;
    justify-content: center;
}

#step4 .step4-category-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

#step4 .step4-category-name {
    font-size: clamp(11px, 2.8vw, 14px);
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
    transition: color 0.3s;
}

/* Navigation */
#step4 .step4-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step4 .step4-back,
#step4 .step4-next {
    flex: 1;
    padding: clamp(12px, 3vh, 16px) clamp(16px, 4vw, 24px);
    border: none;
    border-radius: clamp(12px, 3vw, 16px);
    font-size: clamp(14px, 3.5vw, 16px);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(6px, 1.5vw, 8px);
    -webkit-tap-highlight-color: transparent;
}

#step4 .step4-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step4 .step4-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step4 .step4-next {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

#step4 .step4-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(59, 130, 246, 0.6);
}

#step4 .step4-next:disabled {
    background: rgba(148, 163, 184, 0.5);
    cursor: not-allowed;
    box-shadow: none;
}

/* Modal styles */
#subcategoriesModal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: clamp(16px, 4vw, 24px);
}

#subcategoriesModal .modal-content {
    background: white;
    border-radius: clamp(16px, 4vw, 24px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-width: 600px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    padding: clamp(20px, 5vw, 32px);
    position: relative;
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

#subcategoriesModal .modal-close {
    position: absolute;
    top: clamp(12px, 3vw, 16px);
    right: clamp(12px, 3vw, 16px);
    background: none;
    border: none;
    font-size: clamp(24px, 6vw, 32px);
    color: #94a3b8;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1;
}

#subcategoriesModal .modal-close:hover {
    color: #1e293b;
}

#subcategoriesModal .modal-title {
    font-size: clamp(18px, 4.5vw, 24px);
    font-weight: 800;
    color: #1e293b;
    margin: 0 0 clamp(20px, 5vh, 28px);
}

#subcategoriesModal .subcat-section {
    margin-bottom: clamp(24px, 6vh, 32px);
}

#subcategoriesModal .subcat-section-title {
    font-size: clamp(14px, 3.5vw, 16px);
    font-weight: 700;
    color: #3b82f6;
    margin-bottom: clamp(10px, 2.5vh, 14px);
}

#subcategoriesModal .subcat-grid {
    display: flex;
    flex-wrap: wrap;
    gap: clamp(8px, 2vw, 12px);
}

#subcategoriesModal .subcat-btn {
    background: #eff6ff;
    border: 2px solid #bfdbfe;
    border-radius: clamp(10px, 2.5vw, 14px);
    padding: clamp(8px, 2vh, 10px) clamp(12px, 3vw, 16px);
    font-size: clamp(12px, 3vw, 14px);
    font-weight: 600;
    color: #1e40af;
    cursor: pointer;
    transition: all 0.3s;
}

#subcategoriesModal .subcat-btn:hover {
    background: #dbeafe;
    border-color: #93c5fd;
}

#subcategoriesModal .subcat-btn.selected {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

#subcategoriesModal .modal-footer {
    display: flex;
    justify-content: flex-end;
    margin-top: clamp(24px, 6vh, 32px);
}

#subcategoriesModal .modal-save {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: clamp(12px, 3vw, 16px);
    padding: clamp(12px, 3vh, 14px) clamp(24px, 6vw, 32px);
    font-size: clamp(14px, 3.5vw, 16px);
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    transition: all 0.3s;
}

#subcategoriesModal .modal-save:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(16, 185, 129, 0.6);
}

#subcategoriesModal .modal-save:disabled {
    background: #94a3b8;
    cursor: not-allowed;
    box-shadow: none;
}

/* Toast */
#step4 .step4-toast {
    position: fixed;
    bottom: clamp(80px, 15vh, 100px);
    left: 50%;
    transform: translateX(-50%) translateY(150%);
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    padding: clamp(10px, 2.5vh, 14px) clamp(16px, 4vw, 22px);
    border-radius: clamp(14px, 3.5vw, 20px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: clamp(8px, 2vw, 12px);
    font-size: clamp(12px, 3vw, 15px);
    font-weight: 700;
    z-index: 10000;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 2px solid rgba(59, 130, 246, 0.3);
}

#step4 .step4-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step4 .step4-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step4 .step4-toast.error i {
    color: #ef4444;
}
</style>

<fieldset id="step4" class="hidden" aria-labelledby="step4Title">
    <div class="step4-header">
        <div class="step4-icon">
            <i class="fas fa-hands-helping"></i>
        </div>
        <h2 id="step4Title" class="step4-title">What kind of help do you provide?</h2>
    </div>
    
    <div class="step4-container" id="step4CategoriesContainer">
        <!-- Categories will be loaded here dynamically -->
    </div>
    
    <div class="step4-nav">
        <button type="button" id="backToStep3" class="step4-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="chooseSubcatBtn" class="step4-next" disabled>
            <span>Choose Subcategories</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="step4-toast">
        <i class="fas fa-exclamation-circle"></i>
        <span class="step4-toast-text"></span>
    </div>
</fieldset>

<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';
    
    // ====== CONFIG ======
    const PREV_STEP_ID = 'step3';
    const NEXT_STEP_ID = 'step5';

    // ====== ELEMENTS ======
    const step4 = document.getElementById('step4');
    if (!step4) return;

    const backToStep3 = document.getElementById('backToStep3');
    const chooseSubcatBtn = document.getElementById('chooseSubcatBtn');
    const categoriesContainer = document.getElementById('step4CategoriesContainer');
    const toast = step4.querySelector('.step4-toast');
    const toastText = step4.querySelector('.step4-toast-text');

    // ====== STATE ======
    let selectedCategories = {}; // {catId: catName}
    let cachedCategories = null; // Cache categories to avoid re-fetching

    // ====== HELPERS ======
    function goToStep(stepId) {
        document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
        const target = document.getElementById(stepId);
        if (target) {
            target.classList.remove('hidden');
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            document.dispatchEvent(new CustomEvent('wizard:stepchange', { detail: { stepId } }));
        }
    }

    function showToast(msg, type = 'error') {
        toast.classList.remove('error', 'show');
        toastText.textContent = msg;
        toast.classList.add(type, 'show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function haptic(intensity) {
        if ('vibrate' in navigator) {
            navigator.vibrate(intensity);
        }
    }

    // ----- Render main categories -----
    function renderCategories(categories) {
        console.log('🎨 Rendering categories, container:', categoriesContainer);
        if (!categoriesContainer) {
            console.error('❌ Categories container not found!');
            return;
        }
        
        categoriesContainer.innerHTML = '';
        
        const grid = document.createElement('div');
        grid.className = 'step4-grid';
        console.log('📦 Creating grid with', categories.length, 'categories');

        categories.forEach((cat, index) => {
            console.log(`  - Category ${index + 1}:`, cat.name, '(ID:', cat.id, ')');
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'step4-category';
            btn.dataset.id = cat.id;
            
            // Restaurer la sélection si cette catégorie était déjà sélectionnée
            if (selectedCategories[cat.id]) {
                btn.classList.add('selected');
                console.log('  ✓ Restored selection for:', cat.name);
            }

            if (cat.icon_image) {
                btn.innerHTML = `
                    <div class="step4-category-icon">
                        <img src="${cat.icon_image}" alt="${cat.name}">
                    </div>
                    <span class="step4-category-name">${cat.name}</span>
                `;
            } else {
                btn.innerHTML = `<span class="step4-category-name">${cat.name}</span>`;
            }

            btn.addEventListener('click', function () {
                btn.classList.toggle('selected');
                const catId = btn.dataset.id;
                
                if (selectedCategories[catId]) {
                    delete selectedCategories[catId];
                    console.log('❌ Deselected:', cat.name);
                } else {
                    selectedCategories[catId] = cat.name;
                    console.log('✅ Selected:', cat.name);
                }
                
                console.log('📊 Total selected:', Object.keys(selectedCategories).length);
                chooseSubcatBtn.disabled = Object.keys(selectedCategories).length === 0;
                haptic(40);
            });

            grid.appendChild(btn);
        });

        categoriesContainer.appendChild(grid);
        
        // Update button state après le render
        chooseSubcatBtn.disabled = Object.keys(selectedCategories).length === 0;
        console.log('✅ Grid appended to container, button state updated');
    }

    function fetchCategoriesAndRender() {
        // Si on a déjà les catégories en cache, les utiliser
        if (cachedCategories) {
            console.log('✅ Using cached categories');
            renderCategories(cachedCategories);
            return;
        }
        
        console.log('📡 Fetching categories from /api/categories...');
        
        fetch('/api/categories')
            .then(res => {
                console.log('📡 Response status:', res.status);
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                console.log('📦 Categories data received:', data);
                
                if (data?.success && Array.isArray(data.categories)) {
                    console.log('✅ Rendering', data.categories.length, 'categories');
                    cachedCategories = data.categories; // Cache les catégories
                    renderCategories(data.categories);
                } else {
                    console.error('❌ Invalid data structure:', data);
                    showToast('Invalid categories data received', 'error');
                }
            })
            .catch(error => {
                console.error('❌ Fetch error:', error);
                showToast('Failed to load categories', 'error');
            });
    }

    // ----- Subcategory Modal -----
    function showSubcategoryModal(subcategoriesByCat) {
        document.getElementById('subcategoriesModal')?.remove();

        const modal = document.createElement('div');
        modal.id = 'subcategoriesModal';
        modal.innerHTML = `
            <div class="modal-content">
                <button type="button" class="modal-close">&times;</button>
                <h2 class="modal-title">Choose your subcategories</h2>
                <div id="subcatContent"></div>
                <div class="modal-footer">
                    <button type="button" id="saveSubcatBtn" class="modal-save" disabled>Next</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        const subcatContent = modal.querySelector('#subcatContent');
        const selectedSubcats = {}; // {catId: [subcatIds]}

        Object.entries(subcategoriesByCat).forEach(([catId, subcats]) => {
            const section = document.createElement('div');
            section.className = 'subcat-section';

            const categoryName = subcats.categoryName || 'Select Minimum 1 Subcategories';
            section.innerHTML = `<h3 class="subcat-section-title">${categoryName}</h3>`;

            const grid = document.createElement('div');
            grid.className = 'subcat-grid';

            (subcats.subcategories || []).forEach(subcat => {
                const sbtn = document.createElement('button');
                sbtn.type = 'button';
                sbtn.className = 'subcat-btn';
                sbtn.textContent = subcat.name;
                sbtn.dataset.catId = catId;
                sbtn.dataset.subcatId = subcat.id;

                sbtn.addEventListener('click', function () {
                    sbtn.classList.toggle('selected');

                    selectedSubcats[catId] = selectedSubcats[catId] || [];
                    const exists = selectedSubcats[catId].includes(subcat.id);
                    selectedSubcats[catId] = exists
                        ? selectedSubcats[catId].filter(id => id !== subcat.id)
                        : selectedSubcats[catId].concat(subcat.id);

                    const allSelected = Object.keys(subcategoriesByCat).every(cid =>
                        Array.isArray(selectedSubcats[cid]) && selectedSubcats[cid].length > 0
                    );
                    modal.querySelector('#saveSubcatBtn').disabled = !allSelected;
                    haptic(40);
                });

                grid.appendChild(sbtn);
            });

            section.appendChild(grid);
            subcatContent.appendChild(section);
        });

        modal.querySelector('.modal-close').onclick = () => {
            modal.remove();
            haptic(30);
        };

        modal.querySelector('#saveSubcatBtn').onclick = function () {
            const expats = JSON.parse(localStorage.getItem('expats')) || {};
            expats.provider_services = selectedCategories;
            expats.provider_subcategories = selectedSubcats;
            localStorage.setItem('expats', JSON.stringify(expats));

            modal.remove();
            haptic(100);
            goToStep(NEXT_STEP_ID);
        };
    }

    // ----- Show Step 4: always render categories when visible -----
    const observer = new MutationObserver(() => {
        if (!step4.classList.contains('hidden')) {
            console.log('👁️ Step 4 is now visible');
            // Toujours appeler fetchCategoriesAndRender (qui utilisera le cache si disponible)
            fetchCategoriesAndRender();
        }
    });
    observer.observe(step4, { attributes: true, attributeFilter: ['class'] });
    console.log('👁️ MutationObserver set up for step4');

    // ----- Choose Subcategories click -----
    chooseSubcatBtn?.addEventListener('click', function () {
        const catIds = Object.keys(selectedCategories);
        if (catIds.length === 0) {
            showToast('Please select at least one category 🎯', 'error');
            haptic([200, 100, 200]);
            return;
        }

        console.log('📡 Fetching subcategories for:', catIds);
        chooseSubcatBtn.disabled = true;

        Promise.all(
            catIds.map(catId =>
                fetch(`/api/categories/${catId}/subcategories`)
                    .then(res => {
                        console.log(`📡 Subcategories response for ${catId}:`, res.status);
                        if (!res.ok) {
                            throw new Error(`HTTP error! status: ${res.status}`);
                        }
                        return res.json();
                    })
                    .then(data => {
                        console.log(`📦 Subcategories data for ${catId}:`, data);
                        return {
                            catId,
                            categoryName: data?.category?.name || '',
                            subcategories: data?.subcategories || []
                        };
                    })
            )
        ).then(results => {
            console.log('✅ All subcategories loaded:', results);
            const subcategoriesByCat = {};
            results.forEach(r => {
                subcategoriesByCat[r.catId] = {
                    categoryName: r.categoryName,
                    subcategories: r.subcategories
                };
            });
            showSubcategoryModal(subcategoriesByCat);
        }).catch(error => {
            console.error('❌ Subcategories fetch error:', error);
            showToast('Failed to load subcategories', 'error');
        }).finally(() => {
            chooseSubcatBtn.disabled = false;
        });
    });

    // ----- Back button -----
    backToStep3?.addEventListener('click', function () {
        haptic(30);
        goToStep(PREV_STEP_ID);
    });

    console.log('🚀 Step 4 ready - Zero Scroll Mobile-First PERFECTION!');
});
</script>