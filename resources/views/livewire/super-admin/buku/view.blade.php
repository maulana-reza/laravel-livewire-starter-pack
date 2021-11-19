<div>
    @if(auth()->check() && auth()->user()->hasRole('super-admin'))
        <x-slot name="header">
            Kelola Buku
        </x-slot>
    @endif
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            Buku
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">
                <x-default-select name="jenis_buku" :option="\App\Models\Buku::jenis_buku()->prepend('Pilih','')"
                                  title="Jenis Buku"/>
                @if($jenis_buku == \App\Models\Buku::DIGITAL)
                    <x-default-upload-file nama="file" :document="$file" title="File" class="col-span-2" accept=".pdf"/>
                @endif
                <x-default-input nama="judul_buku" class="col-span-2" title="Judul Buku" type="text"/>
                <x-default-input nama="penerbit" class="" title="Penerbit" type="text"/>
                <x-default-input nama="bahasa" class="" type="text" title="bahasa"/>
                <x-default-input nama="isbn" type="text" class="col-span-2" title="ISS/ISBN" type="text"/>
                <div class="col-span-2">
                    <x-jet-label class="mb-2">
                        Kategori
                    </x-jet-label>
                    <livewire:kategori-select
                        name="kategori_id"
                        placeholder="Pilih Kategori"
                        :searchable="true"
                    />
                    <div class="my-2">
                        @foreach($kategori_id as $key => $item)
                            <x-jet-secondary-button class="rounded-full"
                                                    wire:click="removeKategori({{ $key }})">{{$item}} (x)
                            </x-jet-secondary-button>
                        @endforeach
                    </div>
                </div>
                <div class="col-span-2">
                    <x-jet-label class="mb-2">
                        Subjek
                    </x-jet-label>
                    <livewire:subjek-select
                        name="subjek_id"
                        placeholder="Pilih Subjek"
                        :searchable="true"
                    />
                    <div class="my-2">
                        @foreach($subjek_id as $key => $item)
                            <x-jet-secondary-button class="rounded-full"
                                                    wire:click="removeSubjek({{ $key }})">{{$item}} (x)
                            </x-jet-secondary-button>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal',false)">
                close
            </x-jet-secondary-button>
            <x-jet-button wire:click="save">
                simpan
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    <div class="max-w-7xl mx-auto px-8">
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
                @if(auth()->check() && auth()->user()->hasRole('super-admin'))
                    <div class=" text-right ">
                        <x-jet-button wire:click="$set('modal',true)">
                            tambah buku
                        </x-jet-button>
                    </div>
                @endif
            </div>
        </div>
        <div class="grid md:grid-cols-3 sm:grid-cols-2 xs:grid-cols-1 gap-4 w-full my-4">
            @if($table->count() > 0)
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
                                @if(auth()->check() && auth()->user()->hasRole('super-admin'))
                                    <x-jet-secondary-button
                                        onclick="confirm('apakah anda yakin menghapus data ini?') && window.livewire.find('{{$this->id}}').removeBuku({{$item->id}})">
                                        hapus
                                    </x-jet-secondary-button>
                                    <x-jet-secondary-button wire:click="change({{$item->id}})">edit
                                    </x-jet-secondary-button>
                                @endif
                                <a href="{{route('buku.detail',['buku_id'=>$item->id])}}">
                                    <x-jet-button>Detail
                                    </x-jet-button>
                                </a>
                            </div>
                        </x-slot>
                    </x-book-card>
                @endforeach
                {!! $table->links() !!}
            @else
                tidak ada data.
            @endif
        </div>
    </div>
</div>
