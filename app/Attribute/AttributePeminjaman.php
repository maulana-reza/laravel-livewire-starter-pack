<?php


namespace App\Attribute;


trait AttributePeminjaman
{
    public $lama;
    public $buku_id;
    public $buku;

    protected $rules = [
        'lama' => 'required|numeric'
    ];

}
