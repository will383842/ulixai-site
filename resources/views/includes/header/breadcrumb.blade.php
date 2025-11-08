{{-- 
  ═══════════════════════════════════════════════════════════
  🍞 BREADCRUMB COMPONENT - MODERN VERSION (NO ANIMATIONS)
  ═══════════════════════════════════════════════════════════
  Fil d'Ariane moderne et épuré avec SEO optimisé
  Masqué sur la home et le dashboard
  @version 3.0.0
  @updated 2025-01-08
--}}

@php
  $currentPath = request()->path();
  $isHome = $currentPath === '/' || $currentPath === '';
  $isDashboard = str_starts_with($currentPath, 'dashboard');
  $showBreadcrumb = !$isHome && !$isDashboard;
  
  // Build breadcrumb items for Schema.org
  $segments = request()->segments();
  $url = '';
  $breadcrumbItems = [];
  
  foreach($segments as $index => $segment) {
    $url .= '/' . $segment;
    $breadcrumbItems[] = [
      'url' => url($url),
      'title' => ucfirst(str_replace(['-', '_'], ' ', $segment))
    ];
  }
@endphp

@if($showBreadcrumb)
{{-- Schema.org Structured Data for SEO --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Accueil",
      "item": "{{ url('/') }}"
    }
    @foreach($breadcrumbItems as $index => $item)
    ,{
      "@type": "ListItem",
      "position": {{ $index + 2 }},
      "name": "{{ $item['title'] }}",
      "item": "{{ $item['url'] }}"
    }
    @endforeach
  ]
}
</script>

{{-- Modern Breadcrumb UI --}}
<nav aria-label="Breadcrumb" class="w-full bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <ol class="flex items-center space-x-2 py-4 overflow-x-auto scrollbar-hide">
      
      {{-- Home Link --}}
      <li class="flex items-center">
        <a href="/" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-600 hover:text-emerald-600 hover:bg-white">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          <span class="text-sm font-medium hidden sm:inline">Accueil</span>
        </a>
      </li>

      @php
      $url = '';
      @endphp
      
      @foreach($segments as $index => $segment)
        @php
        $url .= '/' . $segment;
        $isLast = $index === count($segments) - 1;
        $title = ucfirst(str_replace(['-', '_'], ' ', $segment));
        @endphp

        {{-- Separator --}}
        <li class="flex items-center" aria-hidden="true">
          <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
          </svg>
        </li>

        {{-- Breadcrumb Item --}}
        <li class="flex items-center">
          @if($isLast)
            {{-- Current Page (Not Clickable) --}}
            <span class="px-3 py-2 text-sm font-semibold text-emerald-600 bg-emerald-50 rounded-lg" aria-current="page">
              {{ $title }}
            </span>
          @else
            {{-- Link to Previous Pages --}}
            <a href="{{ $url }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-emerald-600 hover:bg-white rounded-lg">
              {{ $title }}
            </a>
          @endif
        </li>
      @endforeach

    </ol>
  </div>
</nav>
@endif