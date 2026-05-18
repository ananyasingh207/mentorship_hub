@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-3 border-gray-200 bg-gray-50/50 focus:border-[#006B52] focus:outline-none focus:ring-1 focus:ring-[#006B52]/50 focus:shadow-[0_0_12px_rgba(0,107,82,0.15)] rounded-[2px] shadow-sm transition-all duration-300']) }}>
