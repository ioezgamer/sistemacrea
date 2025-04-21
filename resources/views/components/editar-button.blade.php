<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-5 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 border border-transparent rounded-2xl font-semibold text-sm text-white uppercase tracking-wide hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-200 focus:ring-offset-2 active:from-yellow-700 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 transform space-x-2'
]) }}>
    <!-- Ícono Heroicon "pencil" -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
    </svg>
    <span>{{ $slot }}</span>
</button>
