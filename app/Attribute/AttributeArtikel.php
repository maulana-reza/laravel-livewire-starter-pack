<?php


namespace App\Attribute;


use App\Models\Berita;

trait AttributeArtikel
{
    public $creator_id,
        $cover,
        $judul,
        $content;

    public function mountArtikel($artikel)
    {
        if ($artikel) {
            foreach ((new Berita())->getFillable() as $item) {
                if (@$artikel->{$item}) $this->{$item} = $artikel->{$item};
            }
            $this->cover = asset('storage/' . $artikel->cover);
        }

    }
}
