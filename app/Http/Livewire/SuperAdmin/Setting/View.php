<?php

namespace App\Http\Livewire\SuperAdmin\Setting;

use App\Attribute\AttributeSetting;
use App\Models\Tentang;
use Livewire\Component;

class View extends Component
{
    use AttributeSetting;

    protected $rules = [
        'alamat' => 'required',
        'nomor_hp' => 'required',
        'email' => 'required|email'
    ];

    public function mount()
    {
        $tentang = Tentang::first();
        $this->mountSetting($tentang);
    }

    public function save()
    {
        $data = $this->validate();
        Tentang::updateOrCreate([], $data);
        $this->emit('alert', ['body' => 'Berhasil diubah.', 'tipe' => 'success']);
    }

    public function render()
    {
        return view('livewire.super-admin.setting.view');
    }
}
