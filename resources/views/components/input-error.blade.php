@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'formErrorList']) }}>
        @foreach ((array) $messages as $message)
            <li class="formErrorList__item">{{ $message }}</li>
        @endforeach
    </ul>
@endif
