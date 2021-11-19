<div>
    <div class="border-b flex">
        <h2 class="text-lg border-b-4 border-current">Riwayat Peminjaman Buku</h2>
    </div>
    @if($riwayat->count() > 0)
        @foreach($riwayat as $item)
            <div class="border-b p-4 grid grid-cols-2">
                <div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full"
                                 src="{{$item->user->profile_photo_url}}"
                                 alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{$item->user->name}}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{$item->user->email}}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="">
                        <div class="text-sm font-medium text-gray-900">
                            @if(\App\Models\Peminjaman::onPengajuan($item->buku_id,$item->users_id))
                                <span
                                    class="bg-yellow-400 px-4 py-1 text-xs opacity-80 border border-yellow-500 rounded uppercase">butuh verifikasi</span>
                            @elseif(\App\Models\Peminjaman::hasVerif($item->buku_id,$item->users_id))
                                <span
                                    class="bg-green-500 px-4 py-1 text-xs opacity-80 border border-green-500 rounded uppercase">terkonfirmasi</span>
                            @elseif(\App\Models\Peminjaman::tertolak($item->buku_id,$item->users_id))
                                <span
                                    class="bg-yellow-400 px-4 py-1 text-xs opacity-80 border border-yellow-500 rounded uppercase">ditolak</span>
                            @endif

                        </div>
                        <div class="text-sm text-gray-500">
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @else
        <div class="text-center my-4">tidak ada data</div>

    @endif

</div>
