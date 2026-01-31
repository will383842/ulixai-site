@props([
    'status' => 'approved',
    'size' => 'sm', // sm, md, lg
])

@php
    $configs = [
        'approved' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-700',
            'icon' => 'fa-check-circle',
            'label' => __('moderation.status.approved'),
        ],
        'pending_review' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-700',
            'icon' => 'fa-clock',
            'label' => __('moderation.status.pending'),
        ],
        'blocked' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-700',
            'icon' => 'fa-ban',
            'label' => __('moderation.status.blocked'),
        ],
        'rejected' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-700',
            'icon' => 'fa-times-circle',
            'label' => __('moderation.status.rejected'),
        ],
    ];
    $config = $configs[$status] ?? $configs['pending_review'];

    $sizes = [
        'sm' => 'text-xs px-2 py-0.5',
        'md' => 'text-sm px-2.5 py-1',
        'lg' => 'text-base px-3 py-1.5',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['sm'];
@endphp

@if($status !== 'approved')
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-full font-medium ' . $config['bg'] . ' ' . $config['text'] . ' ' . $sizeClass]) }}>
    <i class="fas {{ $config['icon'] }}"></i>
    {{ $config['label'] }}
</span>
@endif
