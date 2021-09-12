<?php


namespace App\Attribute;

use App\Models\User;

trait AttributeUser
{
    public $role, $password, $password_confirmation, $name, $email;

    public function mountAttribute(User $user)
    {

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = implode(',',$user->roles->pluck('name')->toArray());

    }

}
