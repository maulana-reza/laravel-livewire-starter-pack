<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
    <x-slot name="header">
        Pengaturan
    </x-slot>
    <x-jet-action-section>
        <x-slot name="title">
            Tentang
        </x-slot>
        <x-slot name="description">
            Informasi Perpustakaan.
        </x-slot>
        <x-slot name="content">
            <x-textarea nama="alamat" title="alamat"/>
            <x-default-input nama="nomor_hp" title="Nomor HP" type="text"/>
            <x-default-input nama="email" title="Email" type="email"/>
            <div class="text-right">
                <x-jet-button wire:click="save">
                    simpan
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-action-section>
    <x-jet-section-border/>
    @livewire('super-admin.setting.waktu-operasi',[],key('superadmin'))
</div>
