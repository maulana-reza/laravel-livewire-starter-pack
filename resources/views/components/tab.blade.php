<div>
    @foreach($tab as $key => $item)
        <x-jet-button wire:click="$set('tabButton','{{$key}}')"
                      :class="$tabButton === $key ? 'bg-blue-400 hover:bg-blue-400 mt-1' : 'mt-1'">
            {{$item}}
        </x-jet-button>
    @endforeach
</div>
