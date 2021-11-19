<div>
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8 mb-20 md:mb-0">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
             aria-label="Global">
            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img class="h-8 w-auto sm:h-10"
                             src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                    </a>
                </div>
            </div>
            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                @foreach(\App\Helpers\Navigation::getDefault() as $key => $item)
                    <a href="{{route($key)}}"
                       class="font-medium  {{request()->routeIs($key) ? 'bg-indigo-600 rounded-full px-6 py-2 text-white' : 'text-gray-500'}} hover:text-gray-900">{{$item}}</a>
                @endforeach
                @if(auth()->check())
                    <a href="{{route('login')}}" class="font-medium text-indigo-600 hover:text-indigo-500">Dashboard</a>

                @else
                    <a href="{{route('login')}}" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>

                @endif
            </div>
        </nav>
    </div>
    <div class="fixed w-full z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden ">
        <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="px-5 py-4 flex items-center justify-between">
                <div>
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                </div>
                <div class="-mr-2">
                    <button wire:click="$toggle('menu')" type="button"
                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Close main menu</span>
                        <!-- Heroicon name: outline/x -->
                        @if(!$menu)
                            <x-heroicon-o-menu class="h-6 w-6"/>
                        @else
                            <x-heroicon-o-x class="h-6 w-6"/>
                        @endif
                    </button>
                </div>
            </div>
            @if($menu)
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @foreach(\App\Helpers\Navigation::getDefault() as $key => $item)
                        <a href="{{route($key)}}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">{{$item}}</a>
                    @endforeach
                </div>
                @if(!auth()->check())
                    <a href="{{route('login')}}"
                       class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                        Log in
                    </a>
                @else
                    <a href="{{route('login')}}"
                       class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                        Log in
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>
