@props([
    'status' => 'pending_review',
    'score' => 0,
    'canAppeal' => false,
    'appealUrl' => null,
])

@php
    $configs = [
        'blocked' => [
            'bg' => 'bg-red-50 border-red-200',
            'icon' => 'fa-ban',
            'iconColor' => 'text-red-500',
            'title' => __('notifications.moderation.content_blocked'),
            'titleColor' => 'text-red-800',
            'textColor' => 'text-red-700',
        ],
        'pending_review' => [
            'bg' => 'bg-yellow-50 border-yellow-200',
            'icon' => 'fa-clock',
            'iconColor' => 'text-yellow-500',
            'title' => __('notifications.moderation.content_pending'),
            'titleColor' => 'text-yellow-800',
            'textColor' => 'text-yellow-700',
        ],
        'rejected' => [
            'bg' => 'bg-red-50 border-red-200',
            'icon' => 'fa-times-circle',
            'iconColor' => 'text-red-500',
            'title' => __('notifications.moderation.content_rejected'),
            'titleColor' => 'text-red-800',
            'textColor' => 'text-red-700',
        ],
    ];
    $config = $configs[$status] ?? $configs['pending_review'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . $config['bg']]) }}>
    <div class="flex items-start gap-3">
        <div class="flex-shrink-0">
            <i class="fas {{ $config['icon'] }} {{ $config['iconColor'] }} text-xl"></i>
        </div>
        <div class="flex-grow">
            <h4 class="font-semibold {{ $config['titleColor'] }}">{{ $config['title'] }}</h4>
            <p class="mt-1 text-sm {{ $config['textColor'] }}">
                @if($status === 'blocked')
                    {{ __('notifications.moderation.blocked_message') }}
                @elseif($status === 'pending_review')
                    {{ __('notifications.moderation.pending_message') }}
                @elseif($status === 'rejected')
                    {{ __('notifications.moderation.rejected_message') }}
                @endif
            </p>

            @if($canAppeal && $appealUrl)
            <div class="mt-3">
                <a href="{{ $appealUrl }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                    <i class="fas fa-gavel"></i>
                    {{ __('notifications.moderation.appeal_action') }}
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
