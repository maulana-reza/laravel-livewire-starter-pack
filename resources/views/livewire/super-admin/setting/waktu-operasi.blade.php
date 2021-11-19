<div class="md:grid md:grid-cols-3 md:gap-6">
    <x-jet-section-title>
        <x-slot name="title">Waktu Beroperasi</x-slot>
        <x-slot name="description">Informasi Perpustakaan.</x-slot>
    </x-jet-section-title>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col col-span-2">
        <div class="text-right mb-4">
            <x-jet-secondary-button wire:click="$set('modal',true)">
                Tambah
            </x-jet-secondary-button>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hari
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jam
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Istirahat
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($table as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{\App\Models\WaktuOperasi::dayWeek($item->hari_mulai) .' - '.\App\Models\WaktuOperasi::dayWeek($item->hari_akhir)}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$item->jam_mulai.' - '.$item->jam_akhir}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$item->istirahat_mulai.' - '.$item->istirahat_akhir}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" wire:click="change({{$item->id}})"
                                       class="text-indigo-600 hover:text-indigo-900" onclick="confirm('Apakah anda yakin menghapus data ini?') && @this.remove({{$item->id}})">Hapus</a> | <a href="#" wire:click="change({{$item->id}})"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            Waktu Beroperasi
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-3">
                <x-default-select name="hari_mulai" :option="\App\Models\WaktuOperasi::dayWeek()"
                                  title="Hari Mulai Beroperasi"/>
                <x-default-select name="hari_akhir" :option="\App\Models\WaktuOperasi::dayWeek()"
                                  title="Hari Tutup Beroperasi"/>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <x-default-input nama="jam_mulai" type="time" title="Waktu mulai"/>
                <x-default-input nama="jam_akhir" type="time" title="Waktu Akhir"/>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <x-default-input nama="istirahat_mulai" type="time" title="Istirahat mulai"/>
                <x-default-input nama="istirahat_akhir" type="time" title="Istirahat Akhir"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal',false)">
                tutup
            </x-jet-secondary-button>
            <x-jet-button wire:click="save">
                Simpan
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
