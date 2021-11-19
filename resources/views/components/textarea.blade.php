<div>
    @props(['disabled' => false])
    <x-jet-label for="{{$nama}}" value="{{__(ucfirst(str_replace('_',' ',$title)))}}" class="mb-2"/>
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['placeholder' => $title,'class' => 'border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!} wire:model="{{$nama}}"></textarea>
    @error($nama) <span class="text-red-500">{{ $message }}</span> @enderror
</div>
