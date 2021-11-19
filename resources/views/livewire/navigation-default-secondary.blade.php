<div>
    <nav class="bg-gray-800 w-full h-18 ">
        <div class="max-w-7xl m-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
                             alt="Workflow">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @foreach(\App\Helpers\Navigation::getDefault() as $key => $item)
                                <a href="{{route($key)}}"
                                   class=" text-white {{ request()->routeIs($key) ? 'bg-gray-900 rounded-md' : '' }} px-3 py-2  text-sm font-medium"
                                   aria-current="page">{{$item}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="ml-3 relative">
                            @if(auth()->check())
                                <div>
                                    <button wire:click="$toggle('menuProfile')" type="button"
                                            class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt="">
                                    </button>
                                </div>
                                @if($menuProfile)
                                    <div
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <a href="{{route('dashboard')}}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                           tabindex="-1" id="user-menu-item-0">{{__('Dashoard')}}</a>

                                        <a wire:click="logout" href="" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                           tabindex="-1" id="user-menu-item-2">Sign out</a>
                                    </div>
                                @endif
                            @else
                                <a href="{{route('login')}}">
                                    <x-jet-secondary-button>
                                        login
                                    </x-jet-secondary-button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class=" flex md:hidden">
                    <x-jet-button wire:click="$toggle('menu')">
                        @if(!$menu)
                            <x-heroicon-o-menu class="h-6 w-6"/>
                        @else
                            <x-heroicon-o-x class="h-6 w-6"/>
                        @endif
                    </x-jet-button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            @if($menu)
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    @foreach(\App\Helpers\Navigation::getDefault() as $key => $item)
                        <a href="{{ route($key) }}"
                           class=" {{ request()->routeIs($key) ? 'bg-gray-900 rounded-md' : '' }}  text-white block px-3 py-2  text-base font-medium"
                           aria-current="page">{{$item}}</a>
                    @endforeach
                </div>
                <div class="pt-4 pb-3 border-t border-gray-700">
                    @if(auth()->check())
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                     alt="">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                                <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <a href="#"
                               onclick="confirm('apakah anda yakin keluar?') && window.livewire.find('{{$this.id}}').logout()"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign
                                out</a>
                        </div>
                    @else
                        <div class="mt-3 px-2 space-y-1">
                            <a href="{{route('login')}}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign
                                in</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </nav>

</div>
