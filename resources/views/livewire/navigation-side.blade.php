<div class="w-80 hidden md:block h-full shadow-md bg-white fixed overflow-y-auto top-0 bottom-0  left-0 z-50"
     id="sidenavSecExample">
    <div class="pt-4 pb-2 px-6">
        <div class="bg-blue-200 rounded p-3 mb-3 text-blue-800 border border-blue-800 flex gap-1 items-center" >
            <x-heroicon-o-clock class="w-6 h-6 mr-2"/>
            <div class="text-sm">{{\Carbon\Carbon::now()}}<br><small class="text-xs">{{\Carbon\Carbon::now()->timezoneName}}</small></div>
        </div>
        <div class="flex items-center gap-2">
            <div class="flex-shrink">
                <img class="rounded" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="flex-grow">
                <p class="text-sm font-semibold text-blue-600">{{Auth::user()->name}}</p>
            </div>
        </div>
    </div>
    <hr>
    <ul class="relative px-1">
        @foreach(\App\Helpers\Navigation::get() as $key => $item)
            @if(is_array($item))
                <li class="relative" id="sidenavSecEx2">
                    <a class=" flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer"
                       data-bs-toggle="collapse"
                       data-bs-target="#collapseSidenavSecEx2-{{str_replace(" ","_",$key)}}" aria-expanded="true"
                       aria-controls="collapseSidenavSecEx2-{{str_replace(" ","_",$key)}}">
                        <x-heroicon-s-collection class="w-5 h-5 mr-3"/>
                        <span>{{strtoupper($key)}}</span>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 ml-auto" role="img"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                  d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                        </svg>
                    </a>
                    <ul class="relative accordion-collapse collapse {{\App\Helpers\Navigation::checkSubActive($key,request()->route()->getName()) ? "show" : ""}}" id="collapseSidenavSecEx2-{{str_replace(" ","_",$key)}}"
                        aria-labelledby="sidenavSecEx2" data-bs-parent="#sidenavSecExample">
                        @foreach($item as $k => $i)
                            <li class="relative">
                                <a href="{{route($k)}}"
                                   class="
                                   flex
                                   items-center
                                   text-xs
                                   py-4
                                   pl-12
                                   pr-6
                                   h-6
                                   overflow-hidden
                                   text-gray-700
                                   whitespace-nowrap
                                   rounded
                                   hover:text-blue-600
                                   hover:bg-blue-50
                                   transition
                                   duration-300
                                   ease-in-out
                                   {{request()->routeIs($k) ? 'bg-blue-50 text-blue-600' : ''}}
                                   "
                                >{{strtoupper($i)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="relative">
                    <a class="flex
                    items-center
                    text-sm
                    py-4
                    px-6
                    h-12
                    overflow-hidden
                    text-gray-700
                    text-ellipsis
                    whitespace-nowrap
                    rounded
                    hover:text-blue-600
                    hover:bg-blue-200
                    {{request()->routeIs($key) ? 'bg-blue-200 text-blue-600' : ''}}
                    transition
                    duration-300
                    ease-in-out"
                       href="{{route($key)}}" >
                        <x-heroicon-o-document-text class="w-5 h-5 mr-3"/>
                        <span>{{strtoupper($item)}}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
