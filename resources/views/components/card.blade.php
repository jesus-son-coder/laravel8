
<div {{ $attributes->merge(['class' => 'card']) }}>
    <h2>{{ $slot }}</h2>
    <p>{{ $description }}</p>
    <p>{{ $message }}</p>
</div>

