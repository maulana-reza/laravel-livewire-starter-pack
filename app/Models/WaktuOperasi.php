<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuOperasi extends Model
{
    use HasFactory;
    protected $table = 'waktu_beroperasi';
    public $fillable = [
        'jam_mulai',
        'jam_akhir',
        'istirahat_mulai',
        'istirahat_akhir',
        'hari_mulai',
        'hari_akhir',
    ];
    static public function dayWeek($value = false)
    {
        $weekMap = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        return $value === false ? $weekMap : $weekMap[$value];
    }
}
