<div>
    {{--    <x-jet-button wire:click="$set('add',true)" class="mt-2">--}}
    {{--        Atur Role--}}
    {{--    </x-jet-button>--}}
    <x-jet-dialog-modal wire:model="add" class="text-center">
        <x-slot name="title">
            <div class="text-center">
                {{ __('Tambah Role ( hak akses )') }}
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="text-left">
                <x-default-data-master nama="name" title="Role" :idName="$idRole" :table="$table" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="$set('add',false)">
                close
            </button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
