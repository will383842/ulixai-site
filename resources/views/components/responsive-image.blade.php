{{--
  Responsive Image Component with WebP Support

  Usage:
  <x-responsive-image
    src="images/example.jpg"
    alt="Description"
    :sizes="['sm' => 400, 'md' => 800, 'lg' => 1200]"
    class="w-full h-auto"
    loading="lazy"
  />

  Simple usage:
  <x-responsive-image src="images/example.jpg" alt="Description" />
--}}

@props([
    'src',                          // Image path (relative to public/)
    'alt' => '',                    // Alt text (required for a11y)
    'class' => '',                  // CSS classes
    'sizes' => null,                // Responsive sizes array
    'loading' => 'lazy',            // lazy | eager
    'width' => null,                // Width attribute
    'height' => null,               // Height attribute
    'fetchpriority' => null,        // high | low | auto
])

@php
    // Get file info
    $pathInfo = pathinfo($src);
    $extension = strtolower($pathInfo['extension'] ?? 'jpg');
    $basePath = $pathInfo['dirname'] . '/' . $pathInfo['filename'];

    // Check if WebP version exists
    $webpPath = $basePath . '.webp';
    $hasWebp = file_exists(public_path($webpPath));

    // Determine MIME type
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
    ];
    $mimeType = $mimeTypes[$extension] ?? 'image/jpeg';

    // Build srcset if sizes provided
    $srcset = null;
    $webpSrcset = null;

    if ($sizes && is_array($sizes)) {
        $srcsetParts = [];
        $webpSrcsetParts = [];

        foreach ($sizes as $breakpoint => $width) {
            // Check if sized version exists
            $sizedPath = $basePath . '-' . $width . 'w.' . $extension;
            $sizedWebpPath = $basePath . '-' . $width . 'w.webp';

            if (file_exists(public_path($sizedPath))) {
                $srcsetParts[] = asset($sizedPath) . ' ' . $width . 'w';
            }
            if (file_exists(public_path($sizedWebpPath))) {
                $webpSrcsetParts[] = asset($sizedWebpPath) . ' ' . $width . 'w';
            }
        }

        if (!empty($srcsetParts)) {
            $srcset = implode(', ', $srcsetParts);
        }
        if (!empty($webpSrcsetParts)) {
            $webpSrcset = implode(', ', $webpSrcsetParts);
        }
    }

    // Build attributes
    $imgAttrs = [
        'src' => asset($src),
        'alt' => $alt,
        'class' => $class,
        'loading' => $loading,
    ];

    if ($width) $imgAttrs['width'] = $width;
    if ($height) $imgAttrs['height'] = $height;
    if ($fetchpriority) $imgAttrs['fetchpriority'] = $fetchpriority;
    if ($srcset) $imgAttrs['srcset'] = $srcset;
@endphp

@if($hasWebp || $webpSrcset)
    <picture>
        {{-- WebP source --}}
        <source
            type="image/webp"
            @if($webpSrcset) srcset="{{ $webpSrcset }}" @else srcset="{{ asset($webpPath) }}" @endif
        >

        {{-- Original format source --}}
        <source
            type="{{ $mimeType }}"
            @if($srcset) srcset="{{ $srcset }}" @else srcset="{{ asset($src) }}" @endif
        >

        {{-- Fallback img --}}
        <img
            src="{{ asset($src) }}"
            alt="{{ $alt }}"
            @if($class) class="{{ $class }}" @endif
            loading="{{ $loading }}"
            @if($width) width="{{ $width }}" @endif
            @if($height) height="{{ $height }}" @endif
            @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
            @if($srcset) srcset="{{ $srcset }}" @endif
        >
    </picture>
@else
    {{-- Simple img if no WebP available --}}
    <img
        src="{{ asset($src) }}"
        alt="{{ $alt }}"
        @if($class) class="{{ $class }}" @endif
        loading="{{ $loading }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
        @if($srcset) srcset="{{ $srcset }}" @endif
    >
@endif
