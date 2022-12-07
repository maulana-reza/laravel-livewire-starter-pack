<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<x-jet-banner/>
<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')
    @if (isset($header))
        <header class="bg-white shadow">
            <div
                class="mx-auto py-6 px-4 sm:px-6 gap-5 lg:px-8 md:ml-80 flex items-center md:fixed top-0 left-0 right-0 bg-white z-30 shadow">
                <div class="flex-grow flex gap-2 items-center">
                    <ol class="flex divide-x divide-gray-100 overflow-hidden rounded-lg border border-gray-100 text-sm text-gray-500 sm:grid-cols-3">
                        <li class="flex items-center justify-center p-2 font-black">
                            Navigasi
                        </li>
                        @foreach(($navigation = @\App\Helpers\Navigation::pathNavigation() ?? []) as $key => $item)
                            <li class="flex items-center justify-center p-2 border-r">
                                @if(count($navigation) > 1 && $key < 1)
                                    <x-heroicon-s-collection class="w-5 h-5 mr-3"/>
                                @else
                                    <x-heroicon-o-document-text class="w-5 h-5 mr-3"/>
                                @endif
                                <p class="leading-none">
                                    <strong class="block font-medium"> {{$item}} </strong>
                                </p>
                            </li>
                        @endforeach()
                    </ol>
                </div>
                <div class="flex-shrink">
                <div class="flex-shrink hidden md:block">
                    <x-jet-dropdown class="" align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('MANAGE ACCOUNT') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('PROFILE') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif
                            <div class="border-t border-gray-100"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('LOG OUT') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </header>
        <div class="md:mt-28">
        </div>
    @endif

    @livewire('navigation-side',[],key('navigation-aside'))

    <!-- Page Content -->
    <main class="md:ml-80">
        <div class="mx-auto grid grid-cols-1 gap-5">

            <div class="md:mx-8">
                @if(strlen($slot) > 623)
                    {!! $slot !!}
                @else
                    {{-- on development --}}
                    {!! $slot !!}
                @endif
            </div>
        </div>
    </main>
</div>

@stack('modals')
@livewireScripts
<x-alert/>
@stack('js')

<script>
    function dropdown(value, data_value = "") {
        return {
            options: [],
            selected: [],
            show: false,
            open() {
                this.show = true
            },
            close() {
                this.show = false
            },
            search() {
                console.log(this.input.value())
            },
            isOpen() {
                return this.show === true
            },
            select(index, event) {
                if (!this.options[index].selected) {
                    console.log(event.target,)
                    this.options[index].selected = true;
                    // this.options[index].element = event.target;
                    this.selected.push(index);


                } else {
                    this.selected.splice(this.selected.lastIndexOf(index), 1);
                    this.options[index].selected = false
                }
                let select_value = document.getElementById('select-value-' + value);
                select_value.value = this.selected.map((option) => {
                    return this.options[option].value;
                }).toString()
                select_value.dispatchEvent(new Event('input'));
            },
            remove(index, option) {

                this.options[option].selected = false;
                this.selected.splice(index, 1);

                let select_value = document.getElementById('select-value-' + value);
                select_value.value = this.selected.map((option) => {
                    return this.options[option].value;
                }).toString()
                select_value.dispatchEvent(new Event('input'));


            },
            loadOptions() {
                const options = document.getElementById('select-' + value).options;
                for (let i = 0; i < options.length; i++) {

                    this.options.push({
                        value: options[i].value,
                        text: options[i].innerText,
                        selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                    });
                    if (data_value.includes(options[i].innerText)) {
                        this.options[i].selected = true;
                        this.selected.push(i);
                    }
                }
            },
            selectedValues() {
                return this.selected.map((option) => {
                    return this.options[option].value;
                }).toString()
            }
        }
    }
</script>
</body>
<script src="{{ asset('flowbite/dist/flowbite.js') }}"></script>

</html>
