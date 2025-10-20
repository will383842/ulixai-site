<div id="step4" class="hidden">
  <h2 class="font-bold mb-6 text-xl text-blue-900 text-center">What kind of help do you provide?</h2>
  <div class="space-y-4 mb-6"></div>
  <div class="flex justify-between items-center">
    <button id="backToStep3" class="text-blue-700 hover:underline">Back</button>
    <button id="nextStep4" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Next</button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // ====== CONFIG ======
  const PREV_STEP_ID = 'step3';
  const NEXT_STEP_ID = 'step5'; // <- change if your next step has a different id

  // ====== ELEMENTS ======
  const step4 = document.getElementById('step4');
  if (!step4) return; // safety

  const backToStep3 = document.getElementById('backToStep3');
  const nextStep4  = document.getElementById('nextStep4');

  // ====== STATE ======
  let selectedCategories = {}; // {catId: catName}

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

  function safeShow(el) { if (el) el.style.display = ''; }
  function safeHide(el) { if (el) el.style.display = 'none'; }

  // Hide official next/back initially
  safeHide(backToStep3);
  safeHide(nextStep4);

  // Create "Choose Subcategories" button (shown on Step 4)
  const btnContainer = step4.querySelector('.flex.justify-between.items-center');
  let chooseSubcatBtn = document.getElementById('chooseSubcatBtn');
  if (!chooseSubcatBtn) {
    chooseSubcatBtn = document.createElement('button');
    chooseSubcatBtn.id = 'chooseSubcatBtn';
    chooseSubcatBtn.type = 'button';
    chooseSubcatBtn.className = 'bg-blue-600 text-white px-4 py-2 rounded-lg mt-4';
    chooseSubcatBtn.textContent = 'Choose Subcategories';
    chooseSubcatBtn.disabled = true;
    btnContainer && btnContainer.appendChild(chooseSubcatBtn);
  }

  // ----- Render main categories -----
  function renderCategories(categories) {
    const container = step4.querySelector('.space-y-4.mb-6');
    if (!container) return;
    container.innerHTML = '';
    let row = null;

    categories.forEach((cat, idx) => {
      if (idx % 3 === 0) {
        row = document.createElement('div');
        row.className = 'flex justify-center gap-6 mb-4';
        container.appendChild(row);
      }

      const btn = document.createElement('button');
      btn.className = `
        help-icon w-40 h-24 flex flex-col items-center justify-center rounded-2xl
        bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 border-2 border-blue-200
        shadow-md text-blue-900 text-base font-semibold transition duration-200 ease-in-out
        hover:scale-105 hover:border-blue-400 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-400
      `.replace(/\s+/g, ' ');

      if (cat.icon_image) {
        btn.innerHTML = `
          <div class="w-8 h-8 mb-1 flex items-center justify-center">
            <img src="${cat.icon_image}" alt="${cat.name}" class="w-full h-full object-contain">
          </div>
          <span class="text-center leading-tight">${cat.name}</span>
        `;
      } else {
        btn.textContent = cat.name;
      }

      btn.dataset.id = cat.id;
      btn.style.letterSpacing = '0.5px';
      btn.style.boxShadow = '0 2px 8px 0 rgba(59,130,246,0.07)';

      btn.addEventListener('click', function () {
        btn.classList.toggle('ring-4');
        btn.classList.toggle('ring-blue-400');
        btn.classList.toggle('bg-blue-700');
        btn.classList.toggle('text-white');
        btn.classList.toggle('border-blue-600');

        const catId = btn.dataset.id;
        if (selectedCategories[catId]) {
          delete selectedCategories[catId];
        } else {
          selectedCategories[catId] = cat.name;
        }
        chooseSubcatBtn.disabled = Object.keys(selectedCategories).length === 0;
      });

      row.appendChild(btn);
    });
  }

  function fetchCategoriesAndRender() {
    fetch('/api/categories')
      .then(res => res.json())
      .then(data => {
        if (data?.success && Array.isArray(data.categories)) {
          renderCategories(data.categories);
        }
      })
      .catch(() => {});
  }

  // ----- Subcategory Modal -----
  function showSubcategoryModal(subcategoriesByCat) {
    document.getElementById('subcategoriesModal')?.remove();

    const modal = document.createElement('div');
    modal.id = 'subcategoriesModal';
    modal.className = 'fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center';
    modal.innerHTML = `
      <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <button id="closeSubcatModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 text-2xl font-bold">&times;</button>
        <h2 class="text-xl font-bold text-blue-900 mb-6">Choose your subcategories</h2>
        <div id="subcatContent" class="space-y-12"></div>
        <div class="flex justify-end mt-6">
          <button id="saveSubcatBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full" disabled>Next</button>
        </div>
      </div>
    `;
    document.body.appendChild(modal);

    const subcatContent = modal.querySelector('#subcatContent');
    const selectedSubcats = {}; // {catId: [subcatIds]}

    Object.entries(subcategoriesByCat).forEach(([catId, subcats]) => {
      const catDiv = document.createElement('div');
      catDiv.className = 'mb-6';

      // ✅ Use categoryName (mapped in fetch) not subcats.name
      const categoryName = subcats.categoryName || 'Select Minimum 1 Subcategories';
      catDiv.innerHTML = `<h3 class="font-semibold text-blue-700 mb-2">${categoryName}</h3>`;

      const grid = document.createElement('div');
      grid.className = 'flex flex-wrap gap-3';

      (subcats.subcategories || []).forEach(subcat => {
        const sbtn = document.createElement('button');
        sbtn.className = 'px-4 py-2 rounded-lg border border-blue-200 bg-blue-50 text-blue-800 font-medium hover:bg-blue-100 transition';
        sbtn.textContent = subcat.name;
        sbtn.dataset.catId = catId;
        sbtn.dataset.subcatId = subcat.id;

        sbtn.addEventListener('click', function () {
          sbtn.classList.toggle('bg-blue-700');
          sbtn.classList.toggle('text-white');
          sbtn.classList.toggle('border-blue-600');

          selectedSubcats[catId] = selectedSubcats[catId] || [];
          const exists = selectedSubcats[catId].includes(subcat.id);
          selectedSubcats[catId] = exists
            ? selectedSubcats[catId].filter(id => id !== subcat.id)
            : selectedSubcats[catId].concat(subcat.id);

          const allSelected = Object.keys(subcategoriesByCat).every(cid =>
            Array.isArray(selectedSubcats[cid]) && selectedSubcats[cid].length > 0
          );
          modal.querySelector('#saveSubcatBtn').disabled = !allSelected;
        });

        grid.appendChild(sbtn);
      });

      catDiv.appendChild(grid);
      subcatContent.appendChild(catDiv);
    });

    modal.querySelector('#closeSubcatModal').onclick = () => modal.remove();

    modal.querySelector('#saveSubcatBtn').onclick = function () {
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.provider_services = selectedCategories;   // { catId: catName }
      expats.provider_subcategories = selectedSubcats; // { catId: [subcatIds] }
      localStorage.setItem('expats', JSON.stringify(expats));

      modal.remove();

      // Reveal official buttons (optional), hide chooser
      safeShow(backToStep3);
      safeShow(nextStep4);
      chooseSubcatBtn && safeHide(chooseSubcatBtn);

      // 🚀 Move to the next step immediately
      goToStep(NEXT_STEP_ID);
    };
  }

  // ----- Show Step 4: fetch categories once -----
  const observer = new MutationObserver(() => {
    if (!step4.classList.contains('hidden')) {
      if (!step4.dataset.loaded) {
        fetchCategoriesAndRender();
        step4.dataset.loaded = '1';
      }
      safeHide(backToStep3);
      safeHide(nextStep4);
      chooseSubcatBtn && safeShow(chooseSubcatBtn);
    }
  });
  observer.observe(step4, { attributes: true, attributeFilter: ['class'] });

  // ----- Choose Subcategories click -----
  chooseSubcatBtn?.addEventListener('click', function () {
    const catIds = Object.keys(selectedCategories);
    if (catIds.length === 0) {
      alert('Please select at least one category.');
      return;
    }

    chooseSubcatBtn.disabled = true;

    Promise.all(
      catIds.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`)
          .then(res => res.json())
          .then(data => ({
            catId,
            categoryName: data?.category?.name || '',
            subcategories: data?.subcategories || []
          }))
      )
    ).then(results => {
      const subcategoriesByCat = {};
      results.forEach(r => {
        subcategoriesByCat[r.catId] = {
          categoryName: r.categoryName,
          subcategories: r.subcategories
        };
      });
      showSubcategoryModal(subcategoriesByCat);
    }).finally(() => {
      chooseSubcatBtn.disabled = false;
    });
  });

  // ----- Official Next/Back (if you still use them) -----
  nextStep4?.addEventListener('click', function () {
    goToStep(NEXT_STEP_ID);
  });

  backToStep3?.addEventListener('click', function () {
    goToStep(PREV_STEP_ID);
  });
});
</script>
