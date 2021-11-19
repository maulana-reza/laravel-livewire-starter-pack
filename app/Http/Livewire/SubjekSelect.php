<?php

namespace App\Http\Livewire;

use App\Attribute\AttributeLivewireSelect;
use App\Models\Subjek;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Livewire\Component;

class SubjekSelect extends LivewireSelect
{
    use AttributeLivewireSelect;

    public function options($searchTerm = null): Collection
    {
        $data = Subjek::when($searchTerm, function ($q) use ($searchTerm) {
            $q->where('nama', 'like', '%' . $searchTerm . '%');
        })->get();
        foreach ($data as $datum) {
            $temp[] = [
                'value' => $datum->id,
                'description' => $datum->nama,
            ];
        }
        return collect(@$temp ?? []);
    }

    public function selectedOption($value)
    {
        $datum = Subjek::findOrFail($value);

        $this->emit("subjek_select", $value);
        return [
            'value' => $datum->id,
            'description' => $datum->nama,
        ];
    }
}
