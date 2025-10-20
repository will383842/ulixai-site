<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- JSZip for in-browser zipping -->
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Ulixai – Press</title>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
</head>

<style>
  .upload-overlay {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
    border: 2px dashed #3b82f6;
    transition: all 0.3s ease;
  }
  .upload-overlay:hover {
    border-color: #10b981;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.1));
  }
  .upload-overlay.dragover {
    border-color: #10b981;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(59, 130, 246, 0.2));
    transform: scale(1.02);
  }

  .contact-button {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  }
  .contact-button:hover {
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
  }
</style>

<body class="bg-white text-gray-800">

  @include('includes.header')
  @include('pages.popup')

  <!-- Hero Section -->
  <section class="bg-gradient-to-br from-blue-100 via-white to-blue-50 py-6 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
      <!-- Text Content -->
      <div class="text-center md:text-left">
        <div class="text-5xl mb-4">🌍 ✈️ 📦</div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-4">@site – Press Area</h1>
        <h1 class="text-lg text-gray-700 mb-4">
          For everyone who travels, invests, studies or lives abroad.
        </h1>
        <h1 class="text-base md:text-lg font-medium text-gray-600">
          @site is the only platform that centralizes essential services for vacationers, expats, students, digital nomads, investors, and families living abroad. We are an international, agile, independent startup — and completely human-centered.
        </h1>
      </div>

      <!-- Decorative Image or Icon -->
      <div class="flex justify-center">
        <!-- <img src="images/img 12.png" alt="Press Icon" class="w-72 h-auto opacity-90"> -->
      </div>
    </div>
  </section>

  <!-- Press Kit Section -->
  <section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold text-blue-800 mb-8">📛 Download the {{ config('app.name') }} Press Kit</h2>

      @php
        $icons   = $pressItems->filter(fn($p) => !empty($p->icon))->sortByDesc('updated_at');
        $photos  = $pressItems->filter(fn($p) => !empty($p->photo))->sortByDesc('updated_at');
        $pdfs    = $pressItems->filter(fn($p) => !empty($p->pdf))->sortByDesc('updated_at');
        $guides  = $pressItems->filter(fn($p) => !empty($p->guideline_pdf))->sortByDesc('updated_at');

        $latestIcon  = $icons->first();
        $latestPhoto = $photos->first();
        $latestPdf   = $pdfs->first();
        $latestGuide = $guides->first();
      @endphp

      @if($pressItems->isEmpty())
        <p class="text-gray-500">No press assets available yet. Please check back later.</p>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">

          {{-- Card 1 - Official Logo (Icon) --}}
          <div class="bg-blue-50 rounded-xl p-6 border border-blue-300 shadow hover:shadow-lg transition">
            <div class="mb-4 bg-white rounded-lg p-4 shadow-sm">
              <div class="relative h-40 w-full overflow-hidden rounded-md">
                @if($latestIcon)
                  <img
                    src="{{ route('press.asset', [$latestIcon->id, 'icon']) }}"
                    alt="Official Icon"
                    class="absolute inset-0 w-full h-full object-contain"
                    loading="lazy">
                @else
                  <div class="absolute inset-0 flex items-center justify-center text-4xl text-blue-600">🗂️</div>
                @endif
              </div>
            </div>
            <p class="font-semibold mb-1">Official logo (PNG/SVG)</p>
            @if($latestIcon)
              <div class="flex flex-wrap gap-2 mt-3">
                <button onclick="viewAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}')" 
                        class="inline-block bg-blue-700 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-800 transition">View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}', 'logo.zip')"
                        class="inline-block bg-white border border-blue-300 text-blue-700 font-semibold px-4 py-2 rounded-full hover:bg-blue-50 transition">Download</button>
              </div>
            @else
              <p class="text-sm text-gray-600 mt-3">No logos uploaded yet.</p>
            @endif
          </div>

          {{-- Card 2 - Press Kit (PDF) --}}
          <div class="bg-blue-50 rounded-xl p-6 border border-blue-300 shadow hover:shadow-lg transition">
            <div class="mb-4 bg-white rounded-lg p-4 shadow-sm">
              <div class="relative h-40 w-full overflow-hidden rounded-md bg-white" 
                  id="pdf-preview-{{ $latestPdf ? $latestPdf->id : 'none' }}">
                @if($latestPdf)
                  <div class="absolute inset-0 flex items-center justify-center bg-gray-100 cursor-pointer"
                      onclick="loadPdfPreview('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'pdf-preview-{{ $latestPdf->id }}')">
                    <div class="text-center">
                      <div class="text-4xl text-red-500 mb-2">📄</div>
                      <div class="text-sm text-gray-600">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div class="absolute inset-0 flex items-center justify-center text-4xl text-red-500">📄</div>
                @endif
              </div>
            </div>
            <p class="font-semibold mb-1">Press Kit (PDF)</p>
            @if($latestPdf)
              <div class="flex flex-wrap gap-2 mt-3">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestPdf->id, 'pdf']) }}')" 
                        class="inline-block bg-blue-700 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-800 transition">View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'press-kit.zip')"
                        class="inline-block bg-white border border-blue-300 text-blue-700 font-semibold px-4 py-2 rounded-full hover:bg-blue-50 transition">Download</button>
              </div>
            @else
              <p class="text-sm text-gray-600 mt-3">No press kit PDFs uploaded yet.</p>
            @endif
          </div>

          {{-- Card 3 - Brand Guidelines (PDF) --}}
          <div class="bg-blue-50 rounded-xl p-6 border border-blue-300 shadow hover:shadow-lg transition">
            <div class="mb-4 bg-white rounded-lg p-4 shadow-sm">
              <div class="relative h-40 w-full overflow-hidden rounded-md bg-white" 
                  id="guide-preview-{{ $latestGuide ? $latestGuide->id : 'none' }}">
                @if($latestGuide)
                  <div class="absolute inset-0 flex items-center justify-center bg-gray-100 cursor-pointer"
                      onclick="loadPdfPreview('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'guide-preview-{{ $latestGuide->id }}')">
                    <div class="text-center">
                      <div class="text-4xl text-red-500 mb-2">📄</div>
                      <div class="text-sm text-gray-600">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div class="absolute inset-0 flex items-center justify-center text-4xl text-red-500">📄</div>
                @endif
              </div>
            </div>
            <p class="font-semibold mb-1">Brand Guidelines</p>
            @if($latestGuide)
              <div class="flex flex-wrap gap-2 mt-3">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestGuide->id, 'guideline_pdf']) }}')" 
                        class="inline-block bg-blue-700 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-800 transition">View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'brand-guidelines.zip')"
                        class="inline-block bg-white border border-blue-300 text-blue-700 font-semibold px-4 py-2 rounded-full hover:bg-blue-50 transition">Download</button>
              </div>
            @else
              <p class="text-sm text-gray-600 mt-3">No brand guidelines uploaded yet.</p>
            @endif
          </div>

          {{-- Card 4 - HD Photos --}}
          <div class="bg-blue-50 rounded-xl p-6 border border-blue-300 shadow hover:shadow-lg transition">
            <div class="mb-4 bg-white rounded-lg p-4 shadow-sm">
              <div class="relative h-40 w-full overflow-hidden rounded-md">
                @if($latestPhoto)
                  <img
                    src="{{ route('press.asset', [$latestPhoto->id, 'photo']) }}"
                    alt="HD Photo"
                    class="absolute inset-0 w-full h-full object-contain"
                    loading="lazy">
                @else
                  <div class="absolute inset-0 flex items-center justify-center text-4xl text-green-500">🖼️</div>
                @endif
              </div>
            </div>
            <p class="font-semibold mb-1">HD Photos</p>
            @if($latestPhoto)
              <div class="flex flex-wrap gap-2 mt-3">
                <button onclick="viewAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}')" 
                        class="inline-block bg-blue-700 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-800 transition">View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}', 'photo.zip')"
                        class="inline-block bg-white border border-blue-300 text-blue-700 font-semibold px-4 py-2 rounded-full hover:bg-blue-50 transition">Download</button>
              </div>
            @else
              <p class="text-sm text-gray-600 mt-3">No photos uploaded yet.</p>
            @endif
          </div>

        </div>
      @endif
    </div>
  </section>

  <!-- Key Figures & Milestones -->
<section class="bg-gray-50 py-20 px-6">
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10">
    <!-- Global Expatriation -->
    <div class="bg-white border border-blue-100 p-6 rounded-xl shadow">
      <h3 class="text-xl font-bold text-blue-700 mb-4">🌍 Global Expatriation at a Glance</h3>
      <ul class="list-disc pl-5 text-gray-700 space-y-2">
        <li><strong>304 million people</strong> currently live outside their country of origin (UN, 2023).</li>
        <li>Over <strong>1.645 billion international travelers</strong> every year.</li>
        <li>Mobility keeps growing for work, study, retirement, and family reasons.</li>
      </ul>
      <p class="mt-4 text-gray-700">
        <strong>Key challenges:</strong> administrative procedures, housing, employment, healthcare, and cultural integration.
      </p>
    </div>

    <!-- About Ulixai & SOS Expat -->
    <div class="bg-white border border-blue-100 p-6 rounded-xl shadow">
      <h3 class="text-xl font-bold text-blue-700 mb-4">ℹ️ About Ulixai & SOS Expat</h3>
      <ul class="list-disc pl-5 text-gray-700 space-y-2">
        <li><strong>Ulixai.com</strong>: a digital platform that simplifies expatriates’ lives by centralizing information, services, and guidance.</li>
        <li><strong>SOS-Expat.com</strong>: an on-demand, 24/7 assistance service for urgent needs (legal, housing, healthcare, employment).</li>
        <li><strong>Mission</strong>: make expatriation easier and remove practical and administrative barriers.</li>
      </ul>
      <p class="mt-4 text-gray-700">
        <strong>Commitment:</strong> speed, confidentiality, and reliability.
      </p>
    </div>
  </div>
</section>

  <!-- Modal for viewing PDFs -->
  <div id="pdfModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
          <h3 class="text-lg font-semibold">Document Preview</h3>
          <button onclick="closePdfModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="h-96 md:h-[500px]">
          <iframe id="pdfModalFrame" class="w-full h-full" src=""></iframe>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for viewing images -->
  <div id="assetModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="relative max-w-4xl max-h-[90vh]">
        <button onclick="closeAssetModal()" class="absolute top-4 right-4 text-white text-3xl z-10 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75">&times;</button>
        <img id="assetModalImg" class="max-w-full max-h-full object-contain" src="" alt="">
      </div>
    </div>
  </div>

  <!-- Press Releases Section -->
  <section class="bg-white py-16 px-6">
    <div class="max-w-6xl mx-auto">
      <h3 class="text-2xl font-bold text-blue-800 mb-6 text-center">📰 Recent Press Releases</h3>

      @php
        // Take the latest 3 with a PDF
        $releases = $pressItems->whereNotNull('pdf')->sortByDesc('created_at')->take(3);
      @endphp

      @if($releases->isEmpty())
        <p class="text-center text-gray-500">No press releases yet. Please check back soon.</p>
      @else
        <div class="grid md:grid-cols-3 gap-6">
          @foreach($releases as $pr)
            <div class="bg-blue-50 p-6 rounded-xl shadow hover:shadow-md transition">
              <div class="flex justify-between items-start mb-4">
                <h4 class="font-semibold text-green-700 mb-2">
                  {{ ($pr->title ?: config('app.name').' Press Release') }}
                  — {{ optional($pr->created_at)->format('F Y') }}
                </h4>
              </div>

              <p class="text-sm text-gray-600 mb-4">
                {{ $pr->description ? \Illuminate\Support\Str::limit($pr->description, 160) : config('app.name').' press release.' }}
              </p>

              @if($pr->pdf)
                <div class="flex gap-2">
                  <button onclick="downloadAsset('{{ route('press.asset', [$pr->id, 'pdf']) }}', '{{ $pr->title ? \Illuminate\Support\Str::slug($pr->title) : 'press-release' }}-{{ optional($pr->created_at)->format('Y-m') }}.zip')"
                          class="flex-1 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full text-center transition-colors shadow-sm">
                    Download
                  </button>
                </div>
              @else
                <span class="bg-gray-200 text-gray-600 p-2 rounded-full text-center block">No PDF available</span>
              @endif
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>
  <div class="flex justify-center items-center my-10">
  <button onclick="openModal()" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-full text-lg">
    Contact-us
  </button>
</div>

<!-- FORM MODAL -->
<div id="contactModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-lg p-8 rounded-2xl shadow-xl relative h-[750px]">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>

    <div class="flex items-center gap-2 mb-6">
      <img src="https://img.icons8.com/emoji/48/memo.png" class="w-6 h-6" />
      <h2 class="text-xl font-bold">press relations</h2>
    </div>

    <form onsubmit="submitForm(event)" class="space-y-4">
      <input type="text" placeholder="Media name " class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <input type="text" placeholder="Your full name" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <input type="text" placeholder="Phone number (with country code)" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <input type="text" placeholder="Website if you have" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <input type="email" placeholder="your email" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <input type="text" placeholder="Languages spoken" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      

      <input type="text" placeholder="How did you hear about Ulixai?" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
      <textarea placeholder="A little words" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm h-24"></textarea>

      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-full w-full font-semibold flex items-center justify-center gap-2">
        <input type="checkbox" checked class="accent-green-500" />
        Submit my partnership request
      </button>
    </form>
  </div>
</div>

<!-- THANK YOU POPUP -->
<div id="thankYouModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white px-8 py-10 rounded-xl shadow-xl max-w-md text-center relative">
    <img src="https://img.icons8.com/color/96/internet--v1.png" class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-16 h-16" />
    <h2 class="text-xl font-bold text-blue-700 mt-6">Thank you for your request!</h2>
    <p class="mt-2 text-gray-700">We have received it and will get back to you <strong>within 24 hours</strong>.</p>
    <p class="mt-2 text-gray-600">See you soon on this exciting <strong>@site</strong> journey 🌍</p>
  </div>
</div>

  <!-- Quotes & Headlines -->
  <section class="bg-gray-50 py-16 px-6">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8">
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-xl font-bold text-blue-700 mb-4">💬 Official Quotes</h3>
        <p class="italic text-gray-700 mb-4">“Whether you’re leaving for 6 days or 6 years, the unexpected happens fast. @site is your human Plan B abroad.”</p>
        <p class="italic text-gray-700">“We created @site to solve real struggles people face when far from home — with real human support.”</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-xl font-bold text-blue-700 mb-4">⚡ Suggested Headlines</h3>
        <ul class="list-disc pl-5 text-gray-800 space-y-2">
          <li>@site, the go-to platform for those on the move</li>
          <li>Travelers, expats, students: finally a simple solution abroad</li>
          <li>No more searching — @site centralizes everything you need abroad</li>
        </ul>
      </div>
    </div>
  </section>

  @include('includes.footer')

  <!-- Scripts -->
  <script>
    /** =========================
     *  ZIP Downloader (single)
     *  ========================= */
    async function downloadAsset(url, suggestedZipName) {
      // Always end with .zip
      let zipName = suggestedZipName || 'download.zip';
      if (!zipName.toLowerCase().endsWith('.zip')) {
        zipName = zipName.replace(/\.[a-z0-9]+$/i, '') + '.zip';
      }

      // Fetch the file (must be same-origin or CORS-enabled)
      let res;
      try {
        res = await fetch(url, { credentials: 'same-origin' });
      } catch (e) {
        console.error('Fetch failed:', e);
        return fallbackDirect(url, zipName);
      }
      if (res.redirected || !res.ok) {
        console.warn('Redirected or HTTP error:', res.status, res.url);
        return fallbackDirect(url, zipName);
      }

      // Derive inner file name from headers or URL
      let inner = inferInnerNameFromHeaders(res) || inferInnerNameFromUrl(url) || 'file.bin';
      if (!/\.[a-z0-9]+$/i.test(inner)) {
        const ext = mimeToExt(res.headers.get('Content-Type')) || 'bin';
        inner += '.' + ext;
      }

      // Build zip in browser
      const blob = await res.blob();
      if (!window.JSZip) {
        console.error('JSZip not loaded');
        return fallbackDirect(url, zipName);
      }
      const zip = new JSZip();
      zip.file(inner, blob);
      const zipBlob = await zip.generateAsync({ type: 'blob' });

      // Trigger browser download
      const a = document.createElement('a');
      const blobUrl = URL.createObjectURL(zipBlob);
      a.href = blobUrl;
      a.download = zipName;
      document.body.appendChild(a);
      a.click();
      a.remove();
      URL.revokeObjectURL(blobUrl);

      function inferInnerNameFromHeaders(response) {
        const cd = response.headers.get('Content-Disposition') || '';
        const m1 = cd.match(/filename\*=(?:UTF-8''|)([^;]+)/i);
        const m2 = cd.match(/filename="([^"]+)"/i);
        const raw = (m1 && m1[1]) || (m2 && m2[1]);
        return raw ? decodeURIComponent(raw.replace(/^UTF-8''/i, '').trim()) : null;
      }
      function inferInnerNameFromUrl(u) {
        try {
          const x = new URL(u, location.href);
          const last = x.pathname.split('/').pop() || '';
          return last.split('?')[0] || null;
        } catch {
          return null;
        }
      }
      function mimeToExt(ct) {
        const t = (ct || '').toLowerCase();
        if (t.includes('pdf')) return 'pdf';
        if (t.includes('svg')) return 'svg';
        if (t.includes('png')) return 'png';
        if (t.includes('jpeg') || t.includes('jpg')) return 'jpg';
        if (t.includes('webp')) return 'webp';
        if (t.includes('gif')) return 'gif';
        return null;
      }
      function fallbackDirect(href, name) {
        const a = document.createElement('a');
        a.href = href;
        a.download = name; // may be ignored for cross-origin
        document.body.appendChild(a);
        a.click();
        a.remove();
      }
    }

    /** ======== PDF Preview ======== */
    function loadPdfPreview(url, containerId) {
      const container = document.getElementById(containerId);
      container.innerHTML = `
        <iframe 
          src="${url}#toolbar=0&navpanes=0" 
          class="absolute inset-0 w-full h-full"
          loading="lazy">
        </iframe>
      `;
    }

    function viewPdfModal(url) {
      const modal = document.getElementById('pdfModal');
      const iframe = document.getElementById('pdfModalFrame');
      
      // Create a blob URL to bypass download managers (if possible)
      fetch(url, {
        method: 'GET',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/pdf'
        }
      })
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.blob();
      })
      .then(blob => {
        const blobUrl = URL.createObjectURL(blob);
        iframe.src = blobUrl + '#toolbar=0&navpanes=0&scrollbar=0';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      })
      .catch(error => {
        console.log('Falling back to direct URL due to:', error);
        iframe.src = url + '#view=FitH&toolbar=0&navpanes=0&scrollbar=0&statusbar=0&messages=0';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      });
    }

    function closePdfModal() {
      const modal = document.getElementById('pdfModal');
      const iframe = document.getElementById('pdfModalFrame');
      if (iframe && iframe.src.startsWith('blob:')) {
        URL.revokeObjectURL(iframe.src);
      }
      if (iframe) iframe.src = '';
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    /** ======== Image Modal ======== */
    function viewAsset(url) {
      const modal = document.getElementById('assetModal');
      const img = document.getElementById('assetModalImg');
      img.src = url;
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    function closeAssetModal() {
      const modal = document.getElementById('assetModal');
      const img = document.getElementById('assetModalImg');
      img.src = '';
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    // Close modals when clicking outside
    document.getElementById('pdfModal').addEventListener('click', function(e) {
      if (e.target === this) closePdfModal();
    });
    document.getElementById('assetModal').addEventListener('click', function(e) {
      if (e.target === this) closeAssetModal();
    });

    /** ======== Upload helpers (as in your original) ======== */
    function triggerUpload(cardId) {
      document.getElementById(`file-input-${cardId}`).click();
    }

    function handleFileUpload(event, cardId) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const uploadArea = document.getElementById(`upload-area-${cardId}`);
          uploadArea.innerHTML = `
            <div class="relative">
              <img src="${e.target.result}" alt="Uploaded image" class="w-full h-32 object-cover rounded-lg mb-2">
              <button onclick="removeImage('${cardId}')" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">
                ×
              </button>
            </div>
            <p class="text-sm text-green-600 font-medium">Photo uploaded successfully!</p>
          `;
        };
        reader.readAsDataURL(file);
      }
    }

    function removeImage(cardId) {
      const uploadArea = document.getElementById(`upload-area-${cardId}`);
      uploadArea.innerHTML = `
        <svg class="w-8 h-8 mx-auto mb-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm text-gray-600">Click or drag photo here</p>
      `;
      document.getElementById(`file-input-${cardId}`).value = '';
    }

    document.addEventListener('DOMContentLoaded', function() {
      ['card1', 'card2', 'card3'].forEach(cardId => {
        const uploadArea = document.getElementById(`upload-area-${cardId}`);
        if (!uploadArea) return;
        uploadArea.addEventListener('dragover', function(e) {
          e.preventDefault();
          this.classList.add('dragover');
        });
        uploadArea.addEventListener('dragleave', function(e) {
          e.preventDefault();
          this.classList.remove('dragover');
        });
        uploadArea.addEventListener('drop', function(e) {
          e.preventDefault();
          this.classList.remove('dragover');
          const files = e.dataTransfer.files;
          if (files.length > 0 && files[0].type.startsWith('image/')) {
            const fileInput = document.getElementById(`file-input-${cardId}`);
            fileInput.files = files;
            handleFileUpload({target: {files: files}}, cardId);
          }
        });
      });
    });

    /** ======== Contact modal ======== */
    function openModal() {
      document.getElementById('contactModal').classList.remove('hidden');
    }
    function closeModal() {
      document.getElementById('contactModal').classList.add('hidden');
    }
    function submitForm(e) {
      e.preventDefault();
      closeModal();
      setTimeout(() => {
        document.getElementById('thankYouModal').classList.remove('hidden');
      }, 200);
      setTimeout(() => {
        document.getElementById('thankYouModal').classList.add('hidden');
      }, 5000); // Auto close after 5 seconds
    }

    // Close modals on outside click
    window.addEventListener('click', function (e) {
      if (e.target.id === 'contactModal') closeModal();
      if (e.target.id === 'thankYouModal') document.getElementById('thankYouModal').classList.add('hidden');
    });

    // Expose helpers globally for inline onclicks
    window.downloadAsset = downloadAsset;
    window.loadPdfPreview = loadPdfPreview;
    window.viewPdfModal = viewPdfModal;
    window.closePdfModal = closePdfModal;
    window.viewAsset = viewAsset;
    window.closeAssetModal = closeAssetModal;
    window.triggerUpload = triggerUpload;
    window.handleFileUpload = handleFileUpload;
    window.removeImage = removeImage;
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.submitForm = submitForm;
  </script>

</body>
</html>
