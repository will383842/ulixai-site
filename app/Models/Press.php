@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Press Library Management</h1>
    <p class="text-gray-600 mb-6">Upload PDFs, photos, icons, and guideline PDFs for your press/brand kit in multiple languages.</p>

    {{-- Upload Card --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-10">
        <form id="pressForm" class="space-y-5" enctype="multipart/form-data">
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title *</label>
                    <input name="title" type="text" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring"
                           placeholder="e.g., Brand Guidelines v1" required/>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Language * <span class="text-red-500">⚠️</span></label>
                    <select name="language" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring bg-white" required>
                        <option value="">-- Select Language --</option>
                        <option value="en">🇬🇧 English</option>
                        <option value="fr">🇫🇷 Français</option>
                        <option value="de">🇩🇪 Deutsch</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">This determines which language page will display this document</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Icon/Logo</label>
                    <input name="icon" type="file" accept=".png,.jpg,.jpeg,.svg,.webp"
                           class="w-full border rounded-lg px-3 py-2"/>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, SVG, WEBP (max 5MB)</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring"
                          placeholder="Short description of what this package contains..."></textarea>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Main PDF</label>
                    <input name="pdf" type="file" accept=".pdf" class="w-full border rounded-lg px-3 py-2"/>
                    <p class="text-xs text-gray-500 mt-1">Press kit or release (max 20MB)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Guideline PDF</label>
                    <input name="guideline_pdf" type="file" accept=".pdf" class="w-full border rounded-lg px-3 py-2"/>
                    <p class="text-xs text-gray-500 mt-1">Brand guidelines (max 20MB)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Photo</label>
                    <input name="photo" type="file" accept=".png,.jpg,.jpeg,.webp"
                           class="w-full border rounded-lg px-3 py-2"/>
                    <p class="text-xs text-gray-500 mt-1">High-res image (max 10MB)</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button id="submitPress" type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg">
                    💾 Save Press Item
                </button>
                <span id="pressStatus" class="text-sm"></span>
            </div>
        </form>
    </div>

    {{-- Delete All Button --}}
    <form action="{{ route('admin.press.deleteAll') }}" method="POST" 
          onsubmit="return confirm('⚠️ Are you sure you want to delete ALL press entries? This cannot be undone!')"
          class="mb-6">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold">
            🗑️ Delete All Press Entries
        </button>
    </form>

    {{-- List Card --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Existing Entries (All Languages)</h2>

        @if ($pressItems->count() === 0)
            <p class="text-gray-500">No entries yet.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pressItems as $item)
                    <div class="border rounded-xl p-4 hover:shadow-lg transition-shadow">
                        {{-- Language Badge --}}
                        <div class="mb-3">
                            @php
                                $langConfig = [
                                    'en' => ['flag' => '🇬🇧', 'name' => 'English', 'color' => 'bg-blue-100 text-blue-800'],
                                    'fr' => ['flag' => '🇫🇷', 'name' => 'Français', 'color' => 'bg-red-100 text-red-800'],
                                    'de' => ['flag' => '🇩🇪', 'name' => 'Deutsch', 'color' => 'bg-yellow-100 text-yellow-800'],
                                ];
                                $lang = $langConfig[$item->language] ?? ['flag' => '🌍', 'name' => 'Unknown', 'color' => 'bg-gray-100 text-gray-800'];
                            @endphp
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold {{ $lang['color'] }}">
                                <span>{{ $lang['flag'] }}</span>
                                <span>{{ $lang['name'] }}</span>
                            </span>
                        </div>

                        <div class="flex items-center gap-3 mb-3">
                            @php
                                $iconUrl = $item->icon ? route('admin.press.preview', [$item->id, 'icon']) : null;
                            @endphp

                            @if($iconUrl)
                                <img src="{{ $iconUrl }}" alt="icon" class="w-10 h-10 object-cover rounded-md">
                            @else
                                <div class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center text-gray-400">
                                    🗂️
                                </div>
                            @endif

                            <div class="flex-1">
                                <div class="font-semibold">{{ $item->title ?? 'Untitled' }}</div>
                                <div class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        @if($item->description)
                            <p class="text-sm text-gray-700 mb-3 line-clamp-3">{{ $item->description }}</p>
                        @endif

                        <div class="space-y-2 text-sm">
                            @if($item->pdf)
                                <div class="flex items-center gap-3">
                                    <button type="button"
                                            class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('admin.press.preview', [$item->id, 'pdf']) }}')">
                                        📄 Preview PDF
                                    </button>
                                    <a href="{{ asset('storage/'.$item->pdf) }}" download class="text-gray-500 hover:underline">
                                        Download
                                    </a>
                                </div>
                            @endif

                            @if($item->guideline_pdf)
                                <div class="flex items-center gap-3">
                                    <button type="button"
                                            class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('admin.press.preview', [$item->id, 'guideline_pdf']) }}')">
                                        📘 Preview Guideline PDF
                                    </button>
                                    <a href="{{ asset('storage/'.$item->guideline_pdf) }}" download class="text-gray-500 hover:underline">
                                        Download
                                    </a>
                                </div>
                            @endif

                            @if($item->photo)
                                <div class="flex items-center gap-3">
                                    <button type="button"
                                            class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('admin.press.preview', [$item->id, 'photo']) }}')">
                                        🖼️ Preview Photo
                                    </button>
                                    <a href="{{ asset('storage/'.$item->photo) }}" download class="text-gray-500 hover:underline">
                                        Download
                                    </a>
                                </div>
                            @endif

                            @if($item->icon)
                                <div class="flex items-center gap-3">
                                    <button type="button"
                                            class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('admin.press.preview', [$item->id, 'icon']) }}')">
                                        🧩 Preview Icon
                                    </button>
                                    <a href="{{ asset('storage/'.$item->icon) }}" download class="text-gray-500 hover:underline">
                                        Download
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $pressItems->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Press/CV Preview Modal -->
<div id="cvModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
  <div class="bg-white w-full max-w-5xl h-5/6 rounded-xl shadow-2xl overflow-hidden animate-fade-in">
    <div class="flex justify-between items-center px-6 py-4 bg-gray-50 border-b">
      <h3 id="cvModalTitle" class="font-semibold text-gray-800 flex items-center">
        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Preview
      </h3>
      <button onclick="closeCvModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded-full p-2 transition-colors duration-200 text-2xl font-light">
        ×
      </button>
    </div>
    <div class="relative h-full">
      <iframe id="cvFrame" src="" class="w-full h-full bg-gray-100"></iframe>
      <div id="cvLoader" class="absolute inset-0 bg-white flex items-center justify-center">
        <div class="flex items-center space-x-2">
          <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          <span class="text-gray-600">Loading preview...</span>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes fade-in { from {opacity:0; transform:scale(0.95)} to {opacity:1; transform:scale(1)} }
.animate-fade-in { animation: fade-in 0.2s ease-out }
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

<script>
function openCvModal(url, title = 'Preview') {
  const modal  = document.getElementById('cvModal');
  const frame  = document.getElementById('cvFrame');
  const loader = document.getElementById('cvLoader');
  const heading= document.getElementById('cvModalTitle');

  heading && (heading.textContent = title);
  modal.classList.remove('hidden');
  loader.style.display = 'flex';

  frame.onload = function() {
    loader.style.display = 'none';
  };
  frame.src = url;
}

function closeCvModal() {
  const modal  = document.getElementById('cvModal');
  const frame  = document.getElementById('cvFrame');
  const loader = document.getElementById('cvLoader');

  frame.src = "";
  modal.classList.add('hidden');
  loader.style.display = 'flex';
}

// close on backdrop click
document.getElementById('cvModal').addEventListener('click', function(e) {
  if (e.target === this) closeCvModal();
});

// close on Esc
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && !document.getElementById('cvModal').classList.contains('hidden')) {
    closeCvModal();
  }
});

// Form submission
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('pressForm');
    const statusEl = document.getElementById('pressStatus');
    const submitBtn = document.getElementById('submitPress');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validation
        const language = form.querySelector('[name="language"]').value;
        if (!language) {
            statusEl.textContent = '⚠️ Please select a language!';
            statusEl.className = 'text-sm text-red-600';
            return;
        }

        const fd = new FormData(form);
        submitBtn.disabled = true;
        statusEl.textContent = 'Uploading...';
        statusEl.className = 'text-sm text-blue-600';

        try {
            const res = await fetch(`{{ route('admin.press.store') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: fd
            });

            if (!res.ok) {
                const err = await res.json().catch(() => ({}));
                throw new Error(err.message || 'Upload failed');
            }

            const data = await res.json();
            statusEl.textContent = '✅ Saved! Reloading...';
            statusEl.className = 'text-sm text-green-600';
            
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } catch (err) {
            statusEl.textContent = '❌ ' + (err.message || 'Something went wrong.');
            statusEl.className = 'text-sm text-red-600';
        } finally {
            submitBtn.disabled = false;
            setTimeout(() => {
                if (!statusEl.textContent.includes('Reloading')) {
                    statusEl.textContent = '';
                }
            }, 4000);
        }
    });
});
</script>
@endsection
