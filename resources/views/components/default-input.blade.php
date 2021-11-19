<div {{$attributes->merge(['class' => 'mb-4 '])    }}>
    @php($tempLabel = ucfirst(str_replace('_',' ',$title)))
    @php($tempLabel = preg_replace('/([A-Z])/', ' $1',$tempLabel))
    @if(strpos(@$attributes['class'] ?? '','grid') > -1)
        <x-jet-label class="" for="{{$nama}}" value="{{__( $tempLabel)}}"
                     class="mb-2 text-lg"/>
    @else
        <x-jet-label for="{{$nama}}" value="{{__($tempLabel)}}" class="mb-2"/>
    @endif
    <div class="{{ strpos($attributes['class'] ?? '','grid') > -1 ? 'max-w-xl' :'' }} col-span-2">
        @if($readonly)
            <x-jet-input id="{{$nama}}" class="block mt-1 w-full" type="{{$type}}" name="{{$nama}}"
                         value="{{old($nama)}}"
                         required
                         readonly="true"
                         :placeholder="$tempLabel"
                         autofocus wire:model="{{$nama}}" :class="$attributes['class'].' w-full '"/>
        @else
            <x-jet-input id="{{$nama}}" class="block mt-1 w-full lowercase" type="{{$type}}" name="{{$nama}}"
                         value="{{old($nama)}}"
                         required

                         :placeholder="$tempLabel"
                         autofocus wire:model="{{$nama}}" :class="$attributes['class'].' w-full '"/>

        @endif
        {{--    @if(!strpos($nama,'.'))--}}
        @error($nama) <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    {{--    @else--}}
    {{--        @php($explode = explode('.',$nama))--}}
    {{--    @php($errorMess = $errors->toArray())--}}
    {{--        @dump(@$errorMess)--}}
    {{--        @if(@$errorMess[$explode[0]][$explode[1]]) <span class="text-red-500">  {{ @$errorMess[$explode[0]][$explode[1]] }}</span> @endif--}}
    {{--    @endif--}}
</div>
