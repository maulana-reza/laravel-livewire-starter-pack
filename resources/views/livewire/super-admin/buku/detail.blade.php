<div class="max-w-7xl mx-auto sm:px-0 md:px-8">
    <x-slot name="header">
        Detail Buku
    </x-slot>
    @if(auth()->user()->hasRole('general'))
        <a href="{{route('general.buku.list')}}">
            <x-jet-secondary-button class="mt-6">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2"/>
                dashboard buku
            </x-jet-secondary-button>
        </a>
    @elseif(auth()->user()->hasRole('pustakawan'))
        <a href="{{route('pustakawan.buku.verify')}}">
            <x-jet-secondary-button class="mt-6">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2"/>
                List Verifikasi Peminjaman
            </x-jet-secondary-button>
        </a>
    @elseif(auth()->user()->hasRole('super-admin'))
        <a href="{{route('buku.list')}}">
            <x-jet-secondary-button class="mt-6">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2"/>
                List Buku
            </x-jet-secondary-button>
        </a>
    @endif
    <div
        class="border grid sm:grid-cols-1 md:grid-cols-2 sm:gap-4 shadow-lg md:gap-8 mt-2 mb-4 bg-white rounded-md p-6">
        <div class="bg-center bg-cover h-auto shadow-lg rounded-lg r"
             style="background-image: url('{{asset('storage/'.$buku->cover)}}')">
        </div>
        <div class="h-auto">
            <div class="border-b flex">
                <h2 class="text-lg border-b-4 border-current"> Detail Buku</h2>
            </div>
            <div class="my-4">
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">Judul Buku</x-jet-label>
                    {{ucfirst($buku->judul_buku)}}
                </div>
            </div>
            <div class="my-4">
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">Subjek</x-jet-label>
                    <div class="flex gap-2">
                        @foreach($buku->subjek_buku as $subjek)
                            <div class="px-1 w-auto border rounded-lg">
                                {{$subjek->subjek->nama}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">
                        Kategori
                    </x-jet-label>
                    <div class="flex gap-2">
                        @foreach($buku->kategori_buku as $subjek)
                            <div class="px-1 w-auto border rounded-lg">
                                {{$subjek->kategori->nama}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">
                        Penerbit
                    </x-jet-label>
                    <div class="">
                        {{$buku->penerbit}}
                    </div>
                </div>
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">
                        isbn/issn
                    </x-jet-label>
                    <div class="">
                        {{$buku->isbn}}
                    </div>
                </div>
                <div class="mb-4 border-b pb-2">
                    <x-jet-label class="uppercase">
                        bahasa
                    </x-jet-label>
                    <div class="">
                        {{$buku->bahasa}}
                    </div>
                </div>
                @if($canRead)
                    <div class="text-right">
                        <x-jet-secondary-button>
                            Baca
                        </x-jet-secondary-button>
                    </div>
                @elseif($canPinjam)

                    <div class="text-right">
                        <x-jet-secondary-button wire:click="$set('pinjam',true)">
                            Pinjam
                        </x-jet-secondary-button>
                    </div>
                    <x-jet-dialog-modal wire:model="pinjam">
                        <x-slot name="title">
                            Waktu Peminjaman
                        </x-slot>
                        <x-slot name="content">
                            <x-default-input type="number" title="Lama Peminjaman (hari)" nama="lama"/>
                        </x-slot>
                        <x-slot name="footer">
                            <div class="text-right">
                                <x-jet-secondary-button wire:click="$set('pinjam',false)">
                                    close
                                </x-jet-secondary-button>
                                <x-jet-button wire:click="pinjam">
                                    simpan
                                </x-jet-button>
                            </div>

                        </x-slot>
                    </x-jet-dialog-modal>
                @endif
            </div>
        </div>
    </div>
    @if(auth()->user()->hasRole(['super-admin','pustakawan']))
        <div class="col-span-2 bg-white p-4 rounded-md shadow-lg">
            @livewire('super-admin.buku.riwayat',['buku_id'=>$buku_id],key('riwayat-buku-id-'.$buku_id))
        </div>
    @endif
</div>
