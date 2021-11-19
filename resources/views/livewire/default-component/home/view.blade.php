<div class="relative bg-white overflow-hidden">
    <x-slot name="home">

    </x-slot>
    <div class=" mx-auto">
        <div
            class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-4xl lg:w-full lg:h-screen lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                 fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100"/>
            </svg>
            @livewire('navigation-default',[],key('default-navigation'))
            <div class="h-full inline-block flex ">
                <main class="my-auto mx-auto px-4 sm:mt-12 sm:px-6 md:mt-16 lg:my-auto lg:px-8 xl:my-auto">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            Selamat Datang di
                            <span class="block text-indigo-600 xl:inline">{!! env('APP_NAME') !!}</span>
                        </h1>
                        <p class="mt-3 text-base flex gap-2 text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            <x-jet-input
                                class="rounded-full w-full px-4 bg-gray-100 h-10 shadow-2xl shadow-inner"
                                placeholder="Temukan Koleksi Buku Menarik"/>
                            <x-jet-button class="rounded-full px-8">temukan</x-jet-button>
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:h-screen">
        <img class="h-56 w-full object-cover sm:h-72 md:h-full lg:w-full lg:h-full"
             src="{{asset('img/lib.jpg')}}"
             alt="">
    </div>
</div>
