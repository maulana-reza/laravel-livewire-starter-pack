<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    protected $table = "tentang";
    protected $fillable = [
        'alamat',
        'nomor_hp',
        'email'
    ];

    public static function currentAlamat()
    {
        $alamat = self::first();
        return @$alamat->alamat ?? '--';
    }
    public static function currentNomorHP()
    {
        $alamat = self::first();
        return @$alamat->nomor_hp ?? '--';
    }
    public static function currentEmail()
    {
        $alamat = self::first();
        return @$alamat->email ?? '--';
    }

}
