<?php

namespace App\Http\Livewire\SuperAdmin\Users;

use App\Attribute\AttributeUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public $add = false;
    public $user_id;
    use AttributeUser;

    protected $rules = [
        'role' => 'required',
        'email' => '',
        'name' => 'required',
        'password' => 'confirmed|nullable|sometimes',
    ];
    public $listeners = [
        'editUser'
    ];

    public function editUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $this->user_id = $user_id;
        $this->mountAttribute($user);
        $this->add = true;
    }

    public function render()
    {
        return view('livewire.super-admin.users.edit');
    }

    public function save()
    {
        $this->rules['email'] = ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($this->user_id)];
        $data = $this->validate($this->rules);
        $this->clearValidation();
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user = User::findOrFail($this->user_id);
        $user->update($data);
        $this->add = false;
        $this->emit('alert', ['tipe' => 'success', 'body' => 'User : <b>' . $user->name . '</b> berhasil ditambahkan']);
        $this->emitUp('refresh');
    }

}
