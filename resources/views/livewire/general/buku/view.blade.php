<div class="max-w-7xl md:px-8 px-2">
    <x-slot name="header">
        Buku
    </x-slot>
    <div class="mt-10">
        <x-tab :tab="$tab" :tabButton="$tabButton"/>
        @if($tabButton == 'peminjaman' || $tabButton == 'buku')
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
                        <x-book-card :image="asset('storage/'.$item->cover)" :title="$item->judul_buku" kategori="test"
                                     subjek="test">
                            <x-slot name="detail">
                                <div
                                    class="text-xs text-gray-600 -mt-3 mb-3">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</div>
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
                                    @if(\App\Models\Peminjaman::onPengajuan($item->id,$item->users_id))
                                        <span
                                            class="bg-yellow-400 px-4 py-1 text-xs opacity-80 border border-yellow-500 rounded uppercase">butuh verifikasi</span>
                                    @elseif(\App\Models\Peminjaman::hasVerif($item->id,$item->users_id))
                                        <span
                                            class="bg-yellow-400 px-4 py-1 text-xs opacity-80 border border-yellow-500 rounded uppercase">berakhir :</span>
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
                {!! $table->links() !!}
            @else
                <div class="text-center mt-10">
                    tidak ada data.
                </div>
            @endif
        @elseif($tabButton == 'riwayat')
        @endif
    </div>
</div>
