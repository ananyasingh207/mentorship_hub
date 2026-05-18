<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#006B52] border border-transparent rounded-[2px] font-bold text-[11px] text-white uppercase tracking-[0.2em] hover:bg-[#005a45] focus:bg-[#005a45] active:bg-[#004d3b] focus:outline-none focus:ring-1 focus:ring-[#006B52]/50 focus:shadow-[0_0_12px_rgba(0,107,82,0.15)] focus:ring-offset-2 shadow-md transition-all duration-300']) }}>
    {{ $slot }}
</button>
