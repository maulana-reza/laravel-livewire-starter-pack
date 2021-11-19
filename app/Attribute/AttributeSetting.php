<?php


namespace App\Attribute;


use App\Models\Tentang;

trait AttributeSetting
{
    public $alamat, $nomor_hp, $email;

    public function mountSetting($setting)
    {
        if ($setting) {
            foreach ((new Tentang())->getFillable() as $item) {
                if (@$setting->{$item}) $this->{$item} = $setting->{$item};
            }
        }
    }

}
