<h1 class="text-4xl font-bold mb-4">
    <a {{ $attributes->merge(['class' => 'text-blue-500 hover:underline']) }}>
        {{ $slot }}
    </a>
</h1>