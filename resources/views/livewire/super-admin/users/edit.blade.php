<div>
    <x-jet-dialog-modal wire:model="add" class="text-center">
        <x-slot name="title">
            <div class="text-center">
                {{ __(($user_id ? 'Ubah ' : "Tambah").' Pengguna') }}
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="text-left">
                <x-default-input type="text" nama="name" title="Name"/>
                <x-default-input type="email" nama="email" title="Email"/>
                <div>
                    <x-jet-label>
                        Role
                    </x-jet-label>
                    <x-select multiple="true" :option="Spatie\Permission\Models\Role::all()->pluck('name','name')"
                              :value="$role" name="role"/>
                    @error($role) <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <x-default-input type="password" nama="password" title="Password"/>
                <x-default-input type="password" nama="password_confirmation" title="Confirm Password"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button wire:click="save">
                simpan
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
