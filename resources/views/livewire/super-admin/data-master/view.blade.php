<div>

    <div class="max-w-7xl mx-auto px-8 my-4">
        <x-slot name="header">
            Data Master
        </x-slot>
        <div>
            <x-tab :tab="$tab" :tabButton="$tabButton"/>
        </div>
    </div>

    @if($tabButton == "kategori")
        @livewire('super-admin.kategori.view',[],key('kategori'))
    @elseif($tabButton == "subjek")
        @livewire('super-admin.subjek.view',[],key('subjek'))
    @endif
</div>
