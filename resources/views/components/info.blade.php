<div {!! $attributes !!}>
    @if($type == "success")
        @php($class = "text-blue-600 bg-blue-100")
    @elseif($type == "danger")
        @php($class = "text-red-600 bg-red-100")
    @else
        @php($class = "text-blue-600 bg-blue-100")
    @endif
    <div class="{!! $class !!} p-3 rounded flex items-center gap-4">
        @if($icon)
            <div>
                <x-heroicon-o-information-circle class="w-10 h-10"/>
            </div>
        @endif
        <div>
            {!! $value !!}
        </div>
    </div>
</div>
