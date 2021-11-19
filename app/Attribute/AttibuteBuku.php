<?php


namespace App\Attribute;


use App\Models\Buku;
use Livewire\WithFileUploads;

trait AttibuteBuku
{
    public $judul_buku, $penerbit, $bahasa, $isbn, $file, $jenis_buku, $kategori_id = [], $subjek_id = [];

    public function mountBuku($buku)
    {
        if ($buku) {
            foreach ((new Buku())->getFillable() as $item) {
                if (@$buku->{$item})$this->{$item} = $buku->{$item};
            }
            if ($buku->file) $this->file = asset("storage/".$buku->file);
        }
    }
}
