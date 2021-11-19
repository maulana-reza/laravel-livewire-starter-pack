<?php

namespace App\Http\Livewire\SuperAdmin\Setting;

use App\Attribute\AttributeWaktuOperasi;
use Carbon\Carbon;
use Livewire\Component;

class WaktuOperasi extends Component
{
    use AttributeWaktuOperasi;

    public $modal = false;
    public $waktu_id = false;
    public $rules = [
        'hari_mulai' => 'required',
        'hari_akhir' => 'required',
        'jam_mulai' => 'required',
        'jam_akhir' => 'required',
        'istirahat_mulai' => 'nullable|sometimes',
        'istirahat_akhir' => 'nullable|sometimes',
    ];

    public function render()
    {
        $table = \App\Models\WaktuOperasi::paginate(10);
        return view('livewire.super-admin.setting.waktu-operasi')
            ->with(compact('table'));
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->waktu_id) {
            $waktu = \App\Models\WaktuOperasi::findOrFail($this->waktu_id);
            $waktu->update($data);
            $mess = "Waktu Beroperasi berhasil diubah.";
        } else {
            \App\Models\WaktuOperasi::create($data);
            $mess = "Waktu Beroperasi berhasil ditambahkan";
        }
        $this->waktu_id = false;
        $this->modal = false;
        $this->emit('alert', ['body' => $mess, 'tipe' => 'success']);
    }

    public function change($id)
    {
        $waktu = \App\Models\WaktuOperasi::findOrFail($id);
        $this->mountWaktuOperasi($waktu);
        $this->modal = true;
        $this->waktu_id = $id;
    }
    public function remove($id)
    {
        $waktu = \App\Models\WaktuOperasi::findOrFail($id);
        $waktu->delete();
        $this->emit('alert', ['body' => 'berhasil dihapus.', 'tipe' => 'success']);

    }

}
