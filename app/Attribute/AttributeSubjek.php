<?php


namespace App\Attribute;


use App\Models\Subjek;

trait AttributeSubjek
{
    public $nama, $subjek_id = [];

    public function subjek_select($id)
    {
        $subjek = Subjek::find($id);
        if ($subjek) {
            $this->subjek_id[$id] = $subjek->nama;
        }
    }

    public function removeSubjek($id)
    {
        if (@$this->subjek_id[$id]) unset($this->subjek_id[$id]);
    }
}
