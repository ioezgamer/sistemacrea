@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-300 focus:ring-blue-400 rounded-md shadow-sm']) }}>
