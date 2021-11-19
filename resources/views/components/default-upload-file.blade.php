<div {{$attributes->merge(['class' => 'mb-4'])    }}>
    <x-jet-label for="{{$nama}}" class="mb-2">
        {!! $title !!} {{" - Max Size File: ".ini_get('upload_max_filesize')}}
    </x-jet-label>

    <div
        class="w-full col-span-2"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <!-- File Input -->
        <x-jet-input id="{{$nama}}" class="block mt-1 w-full " accept="{{$accept}}" type="file" name="{{$nama}}"
                     value="{{old($nama)}}"
                     required
                     autofocus wire:model="{{$nama}}" value="{{old($nama)}}"/>
        @error($nama) <span class="text-red-500">{{ $message }}</span> @enderror
        @if($document)
            <div class="my-2">
                <x-jet-label>Preview</x-jet-label>
                @if(is_string($document))
                    <embed class="w-full h-auto min-h-80" src="{{$document}}">
                @else
                    <embed class="w-full h-auto min-h-80" src="{{$document->temporaryUrl()}}">
                @endif
            </div>
    @endif
    <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>
</div>
