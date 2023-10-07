@props(['textColor','bgColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-800',
        'white' => 'text-white',
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'yellow' => 'text-yellow-800',
        'pink' => 'text-pink-800',
        'indigo' => 'text-indigo-800',
        'purple' => 'text-fuchsia-800',
        'green' => 'text-green-800',
        'lime' => 'text-lime-800',
        default => 'text-gray-800',
    };
    
    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-500',
        'blue' => 'bg-blue-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        'pink' => 'bg-pink-500',
        'indigo' => 'bg-indigo-500',
        'purple' => 'bg-fuchsia-800',
        'green' => 'bg-green-500',
        'lime' => 'bg-lime-500',
        default => 'bg-gray-200',
    };
@endphp
<button {{ $attributes }} class="{{$textColor}} {{$bgColor}} rounded-xl px-3 py-1 text-base" >
    {{$slot}}
</button>