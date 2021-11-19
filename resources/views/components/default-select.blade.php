<div {{$attributes->merge(['class' => 'mb-4'])    }}>
    @php($tempLabel = ucfirst(str_replace('_',' ',$title)))
    @php($tempLabel = preg_replace('/([A-Z])/', ' $1',$tempLabel))
    @if(strpos($attributes['class'],'grid'))
        @php($attributes = $attributes->merge(['class' => 'max-w-xl']))
        <x-jet-label class="" for="{{$name}}" value="{{__( $tempLabel)}}"
                     class="mb-2 text-lg"/>
    @else
        <x-jet-label for="{{$name}}" value="{{__($tempLabel)}}" class="mb-2"/>
    @endif
    <div>
        @if($readonly)
            <x-select :readonly="$readonly" :option="$option" :name="$name" value="$value" :multiple="$multiple" :attributes="$attributes"/>
        @else
            <x-select :option="$option" :name="$name" value="$value" :attributes="$attributes" :multiple="$multiple"/>
        @endif
        @error($name) <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
</div>
