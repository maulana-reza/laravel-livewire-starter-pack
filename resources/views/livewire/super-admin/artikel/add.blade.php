<div>
    <x-slot name="header">
        Tambah / Edit Artikel
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <x-default-upload-file nama="cover" title="Cover" :document="$cover" accept=".png,.jpeg,.jpg" />
                    <x-default-input nama="judul" type="text" title="Judul"/>
                    <x-text-area nama="content" title="Deskripsi"/>
                    <div class="text-right my-4">
                        <x-jet-button wire:click="save">simpan</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
