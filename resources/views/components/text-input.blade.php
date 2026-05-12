@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 bg-gray-50/50 focus:border-[#006B52] focus:ring-[#006B52] rounded-[2px] shadow-sm transition-all duration-300']) }}>
