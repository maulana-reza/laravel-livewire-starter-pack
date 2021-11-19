<?php


namespace App\Attribute;


use App\Models\Kategori;

trait AttributeKategori
{
    public $nama, $kategori_id = [];

    public function kategori_select($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) {
            $this->kategori_id[$id] = $kategori->nama;
        }
    }

    public function removeKategori($id)
    {
        if ($this->kategori_id[$id]) unset($this->kategori_id[$id]);
    }

}
