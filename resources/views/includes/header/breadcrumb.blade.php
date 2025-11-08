@php
  $currentPath = request()->path();
  $isHome = $currentPath === '/' || $currentPath === '';
  $isDashboard = str_starts_with($currentPath, 'dashboard');
  $showBreadcrumb = !$isHome && !$isDashboard;
@endphp

@if($showBreadcrumb)
<div class="breadcrumb-container">
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="breadcrumb-item">
      <a href="/">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Accueil</span>
      </a>
    </div>

    @php
    $segments = request()->segments();
    $url = '';
    @endphp

    @foreach($segments as $index => $segment)
      @php
      $url .= '/' . $segment;
      $isLast = $index === count($segments) - 1;
      $title = ucfirst(str_replace(['-', '_'], ' ', $segment));
      @endphp

      <span class="breadcrumb-separator" aria-hidden="true">›</span>

      @if($isLast)
        <div class="breadcrumb-item active" aria-current="page">{{ $title }}</div>
      @else
        <div class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></div>
      @endif
    @endforeach
  </nav>
</div>
@endif