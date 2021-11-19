<x-guest-layout>
    @if(!@$home)
        @livewire('navigation-default-secondary',[],key('navigation-default-secondary'))
        @if(@$header)
            <header class="bg-white shadow ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {!! $header !!}
                    </h1>
                </div>
            </header>
        @endif
    @endif
    {{$slot}}
    <footer class="p-10" style="background-color: #111828;">
        <div class="w-full mb-32 grid-cols-6 grid text-white">

            <div class="mb-3">
                <h4 class="text-white text-gray-300 uppercase mb-1">alamat</h4>
                <div class="text-sm text-gray-300">{{ \App\Models\Tentang::currentAlamat() }}</div>
            </div>
            <div class="mb-3">
                <h4 class="text-white text-gray-300 uppercase mb-1">nomor hp</h4>
                <div class="text-sm text-gray-300">{{ \App\Models\Tentang::currentNomorHP() }}</div>
            </div>
            <div class="mb-3">
                <h4 class="text-white text-gray-300 uppercase mb-1">email</h4>
                <div class="text-sm text-gray-300">{{ \App\Models\Tentang::currentEmail() }}</div>
            </div>
        </div>
        <hr class="border-gray-800 shadow-lg">
        <div class="text-center text-xs text-gray-700 mt-4">
            copyright 2021
        </div>
    </footer>
</x-guest-layout>
