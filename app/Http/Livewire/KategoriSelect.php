<?php

namespace App\Http\Livewire;

use App\Attribute\AttributeLivewireSelect;
use App\Models\Kategori;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Livewire\Component;

class KategoriSelect extends LivewireSelect
{
    use AttributeLivewireSelect;

    public function options($searchTerm = null): Collection
    {
        $data = Kategori::when($searchTerm, function ($q) use ($searchTerm) {
            $q->where('nama', 'like', '%' . $searchTerm . '%');
        })->get();
        foreach ($data as $item) {
            $temp[] = [
                'value' => $item->id,
                'description' => $item->nama
            ];
        }
        return collect(@$temp ?? []);
    }

    public function selectedOption($value)
    {
        $kategori = Kategori::findOrFail($value);
        $this->emit("kategori_select", $value);
        return [
            'value' => 0,
            'description' => "",
        ];
    }
}
