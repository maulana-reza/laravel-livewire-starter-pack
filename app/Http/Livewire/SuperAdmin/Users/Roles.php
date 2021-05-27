<?php

namespace App\Http\Livewire\SuperAdmin\Users;

use App\Models\User;
use App\Repository\SuperAdmin\DataMaster\DataMasterInterface;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

class Roles extends Component implements DataMasterInterface

{
    use WithPagination;

    public $add;
    public $idRole;
    public $name;
    public $rules = [
        'name' => 'required|unique:roles'
    ];

    public function render()
    {
        $table = Role::paginate(5);
        return view('livewire.super-admin.users.roles')
            ->with(['table' => $table]);
    }

    public function save()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $data = $this->validate();
        if ($this->idRole) {
            $role = Role::find($this->idRole);
            $role->update($data);
            $this->emit('alert', ['tipe' => 'success', 'body' => 'Role : <b>' . $role->name . '</b> berhasil diubah.']);
        } else {
            $role = Role::updateOrCreate($data);
            $this->emit('alert', ['tipe' => 'success', 'body' => 'Role : <b>' . $role->name . '</b> berhasil ditambahkan.']);
        }
        $this->idRole = 0;
        $this->emit("refresh");
        $this->reset();
    }

    public function edit(int $id)
    {
        $role = Role::find($id);
        $this->idRole = $id;
        $this->name = $role->name;
        // TODO: Implement edit() method.
    }

    public function remove(int $id)
    {
        $role = Role::findOrFail($id);
        try {

            $user = User::role($role->name);
            if ($user) {
                $this->emit('alert', ['tipe' => 'danger', 'body' => 'Role : <b>' . $role->name . '</b> sedang digunakan']);
            }

        } catch (RoleDoesNotExist $e) {
            $role->delete();
            $this->emit('alert', ['tipe' => 'success', 'body' => 'Role : <b>' . $role->name . '</b> berhasil dihapus']);
        }
        $this->emit("refresh");
        $this->reset();
        // TODO: Implement remove() method.
    }
}
