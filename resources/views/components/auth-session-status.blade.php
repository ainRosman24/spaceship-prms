@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'status-message font-medium text-sm']) }}>
        {{ $status }}
    </div>
@endif
