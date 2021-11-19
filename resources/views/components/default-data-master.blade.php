<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{$title}}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            konfigurasi {{$title}}
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2 lg:col-span-2">
                    <div class="overflow-hidden sm:rounded-md">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                            <form wire:submit.prevent="save"
                                  class="py-6 bg-white border-b border-gray-200 p-4">
                                <div>
                                    <x-default-input type="text" :nama="$nama" :title='($idName ? "Edit " : "")."Nama ".$title'/>
                                </div>
                                <div class="text-right">
                                    <x-jet-button class="">
                                        <x-spinner wire:target="save"/>
                                        Submit
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                        @if($table->count() > 0)
                            <table
                                class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                                <thead class="">
                                @foreach($table as $item)
                                    <tr class="bg-gray-700 flex flex-col flex-no wrap sm:table-row text-xs rounded-l-lg sm:rounded-none mb-2 sm:mb-0 text-white">
                                        <th class="p-3 text-left  h-15 ">No</th>
                                        <th class="p-3 text-left  h-15">Nama {{$title}}</th>
                                        <th class="p-3 text-left  h-15">Aksi</th>
                                    </tr>
                                @endforeach
                                </thead>
                                <tbody class="flex-1 sm:flex-none">
                                @foreach($table as $key => $item)
                                    <tr class="flex flex-col flex-no wrap sm:table-row text-xs mb-2 sm:mb-0 bg-white">
                                        <td class="border-grey-light h-15 hover:bg-gray-100 p-3">{{$table->firstItem() + $key}}</td>
                                        <td class="border-grey-light border-t-2 h-15 hover:bg-gray-100 p-3 truncate">{{$item->{$nama} }}</td>
                                        <td class="border-grey-light border-t-2 h-15 hover:bg-gray-100 p-3 truncate"><button wire:click="edit({{$item->id}})" >Edit</button> | <button onclick="confirm('Apakah anda yakin menghapus: {{$item->name}}') && @this.remove({{$item->id}})" >Delete</button></td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            {!! $table->links() !!}

                        @else
                            <div class="flex flex-row mb-1 sm:mb-0 justify-between mt-3 w-full text-center">
                                <div class="mx-auto">
                                    Tidak Ada Data
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                {{--content here--}}

            </div>
        </div>
    </div>
    <script>

    </script>
    <style>
        html,
        body {
            height: 100%;
        }

        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>

</div>
