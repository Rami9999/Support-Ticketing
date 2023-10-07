<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if($this->activeCategory || $search)
                <button wire:click="clearFilters()" class="gray-500 text-xs mr-3">X</button>
            @endif
            @if($this->activeCategory)
                All Posts From : 
                <x-badge wire:navigate href="{{route('posts.index',['category'=>$this->activeCategory->slug])}}" :textColor='$this->activeCategory->text_color' :bgColor='$this->activeCategory->bg_color'>
                    {{$this->activeCategory->title}}
                </x-badge>
            @endif
            @if($search)
                Containing : <b>{{$search}}</b>
            @endif
            @if($this->activeCategory || $search)
                <span class="gray-500 text-m ml-3"><b>{{count($this->posts) > 1 ?count($this->posts).' results':count($this->posts).' result'}}</b></span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button wire:click="setSort('desc')" class="@if($sort ==='desc') border-b text-yellow-500 @else text-gray-500 @endif py-4">Latest</button>
            <button wire:click="setSort('asc')" class="@if($sort ==='asc') border-b text-yellow-500 @else text-gray-500 @endif py-4 ">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item :post="$post"/>
        @endforeach
    </div>

    <div class="my-3">
        {{$this->posts->onEachSide(1)->links()}}
    </div>
</div>
