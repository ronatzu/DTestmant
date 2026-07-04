@props(['color'=>'blue'])<span {{ $attributes->merge(['class'=>"rounded-full bg-$color-50 px-2.5 py-1 text-xs font-semibold text-$color-700 ring-1 ring-$color-600/10"]) }}>{{ $slot }}</span>
