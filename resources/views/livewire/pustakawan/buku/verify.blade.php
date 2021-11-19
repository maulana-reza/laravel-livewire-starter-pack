<div class="max-w-7xl md:px-8 px-2">
    <x-slot name="header">
        Verifikasi Peminjaman Buku
    </x-slot>
    <div class="mt-10">
        <div class="rounded-md mt-10 p-4 bg-white shadow">
            <div class=" grid xs:grid-cols-1 md:grid-cols-3 gap-4">
                <x-default-select name="order_by" title="Urut Berdasarkan"
                                  :option="$opt_order_by"/>
                <x-default-input nama="cari" title="Cari Nama Buku" class="md:col-span-2" type="text"/>
            </div>
            <div class="grid xs:grid-cols-1 md:grid-cols-2">
                <div class="text-left text-gray-900">
                    Hasil pencarian : {{$table->count()}}
                </div>
            </div>
        </div>
        @if($table->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                @foreach($table as $item)
                    @php($peminjaman = $item)
                    @php($users = $item->user)
                    @php($item = $item->buku)
                    <x-book-card :image="asset('storage/'.$item->cover)" :title="$item->judul_buku" kategori="test"
                                 subjek="test">
                        <x-slot name="detail">
                            <div
                                class="text-xs text-gray-600 -mt-3 mb-3">{{\Carbon\Carbon::parse($peminjaman->created_at)->diffForHumans()}}</div>
                            <div class="flex mt-4">
                                <div class="text-xs px-1">subjek :</div>
                                @foreach($item->subjek_buku as $subjek)
                                    <div class="px-1 w-auto border rounded-lg text-xs">
                                        {{$subjek->subjek->nama}}
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex mb-4">
                                <div class="text-xs px-1">kategori :</div>
                                @foreach($item->kategori_buku as $subjek)
                                    <div class="px-1 w-auto border rounded-lg text-xs">
                                        {{$subjek->kategori->nama}}
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-right">
                                @if(\App\Models\Peminjaman::onPengajuan($item->id,$users->id))
                                    <x-jet-button class="bg-green-500" wire:click="$set('konfirmasi',{{$peminjaman->id}})">
                                        konfirmasi
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="$set('tolak',{{$peminjaman->id}})">
                                        tolak
                                    </x-jet-danger-button>
                                @elseif(\App\Models\Peminjaman::hasVerif($item->id,$users->id))
                                    <span
                                        class="bg-green-400 px-4 py-1 text-xs opacity-80 border border-green-500 rounded uppercase">Terkonfirmasi</span>
                                @else

                                @endif
                                <a href="{{route('buku.detail',['buku_id'=>$item->id])}}">
                                    <x-jet-button>Detail
                                    </x-jet-button>
                                </a>
                            </div>
                        </x-slot>
                    </x-book-card>
                @endforeach
            </div>
            <x-jet-confirmation-modal wire:model="konfirmasi">
                <x-slot name="title">
                    Konfirmasi
                </x-slot>
                <x-slot name="content">
                    {!! sprintf(__('Apakah anda yakin <b>menyetujui</b> peminjaman buku <b>%s</b> oleh <b>%s</b>'),$item->judul_buku,$users->name) !!}
                </x-slot>
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('konfirmasi',false)">
                        cancel
                    </x-jet-secondary-button>
                    <x-jet-button wire:click="konfirmasiBuku">
                        konfirmasi
                    </x-jet-button>
                </x-slot>
            </x-jet-confirmation-modal>
            <x-jet-confirmation-modal wire:model="tolak">
                <x-slot name="title">
                    Konfirmasi
                </x-slot>
                <x-slot name="content">
                    {!! sprintf(__('Apakah anda yakin <b>menolak</b> peminjaman buku <b>%s</b> oleh <b>%s</b>'),$item->judul_buku,$users->name) !!}
                </x-slot>
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('tolak',false)">
                        cancel
                    </x-jet-secondary-button>
                    <x-jet-button wire:click="konfirmasiTolak">
                        konfirmasi
                    </x-jet-button>
                </x-slot>
            </x-jet-confirmation-modal>

            {!! $table->links() !!}
        @else

            <div class="text-center mt-10">
                tidak ada data.
            </div>
        @endif
    </div>
</div>
