<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700 transform focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50'
]) }}>
    <!-- Ícono Heroicon "plus" -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
    <span>{{ $slot }}</span>
</button>