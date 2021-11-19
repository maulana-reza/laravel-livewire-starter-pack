<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    const FISIK = "fisik";
    const DIGITAL = "digital";
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
        'judul_buku',
        'penerbit',
        'bahasa',
        'isbn',
        'jenis_buku',
        'file',
        'cover',
        'users_id'
    ];

    public static function jenis_buku($value = false)
    {
        $arr = [
            self::FISIK => self::FISIK,
            self::DIGITAL => self::DIGITAL
        ];
        return @$arr[$value] ?? collect($arr);
    }

    public function subjek_buku()
    {
        return $this->hasMany(SubjekBuku::class, 'buku_id', 'id');
    }

    public function kategori_buku()
    {
        return $this->hasMany(KategoriBuku::class, 'buku_id', 'id');
    }

    public function riwayat()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'id');
    }
}
