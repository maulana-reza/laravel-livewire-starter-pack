<div>
    @if(auth()->check() && auth()->user()->hasRole('super-admin'))
        <x-slot name="header">
            Kelola Artikel
        </x-slot>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1">
                        <x-default-input nama="judul" type="text" title="Cari"/>
                    </div>
                    @if(auth()->check() && auth()->user()->hasRole('super-admin'))
                        <div class="text-right">
                            <a href="{{route('artikel.add')}}">
                                <x-jet-button>tambah berita</x-jet-button>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @if($article->count() > 0)
                <div class="bg-white my-2 rounded-lg shadow-lg">
                    <ul class="divide-y divide-gray-200 p-4">
                        @foreach($article as $item)
                            <li class="py-12">
                                <article class="space-y-2 xl:grid xl:grid-cols-4 gap-4 ">
                                    <div class="bg-cover w-full border h-48 shadow-lg"
                                         style="background-image: url('{{asset('storage/'.$item->cover)}}')">
                                    </div>
                                    <div class="space-y-5  xl:col-span-3 relative">
                                        <dl>
                                            <dt class="sr-only">Published on</dt>
                                            <dd class="text-base font-medium text-gray-500">
                                                <time
                                                    datetime="{{$item->created_at}}">{{\Carbon\Carbon::parse($item->created_at)->isoFormat("MMMM DD, YYYY")}}</time>
                                            </dd>
                                        </dl>
                                        <div class="space-y-6">
                                            <h2 class="text-2xl font-bold tracking-tight"><a
                                                    class="text-gray-900"
                                                    href="{{ route('default.artikel.detail',['artikel_id' => $item->id]) }}">{{$item->judul}}</a>
                                            </h2>
                                            <div class="prose max-w-none text-gray-500">
                                                <div class="prose max-w-none ">
                                                    <p class="truncate">
                                                        {{$item->content}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2">

                                            <div class="text-base font-medium"><a
                                                    class="text-teal-600 hover:text-teal-700"
                                                    aria-label="Read &quot;Headless UI v1.4: The One With Tabs&quot;"
                                                    href="{{route('default.artikel.detail',['artikel_id' => $item->id])}}">Read
                                                    more →</a></div>
                                            @if(auth()->check() && auth()->user()->hasRole('super-admin'))
                                                <div class="text-right">
                                                    <x-jet-secondary-button
                                                        onclick="confirm('Apakah anda yakin menghapus : {{$item->judul}}') && window.livewire.find('{{$this->id}}').remove({{$item->id}})">
                                                        hapus
                                                    </x-jet-secondary-button>
                                                    <a href="{{route('artikel.edit',['artikel_id' => $item->id])}}">
                                                        <x-jet-secondary-button>edit</x-jet-secondary-button>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="text-center my-4">
                    tidak ada data.
                </div>
            @endif
        </div>
    </div>
</div>
