<?php


namespace App\Attribute;


use App\Models\Berita;

trait AttributeBerita
{
    public $cover, $creator_id, $judul, $content;

    public function mountBerita($berita)
    {
        if ($berita) {
            foreach ((new Berita())->getFillable() as $item) {
                if (@$berita->{$item}) $this->{$item} = $berita->{$item};
            }
        }
    }

}
