@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-danger mt-1']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </div>
@endif
