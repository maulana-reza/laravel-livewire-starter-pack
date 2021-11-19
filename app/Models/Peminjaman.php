<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = [
        'buku_id',
        'kode_peminjaman',
        'mulai_peminjaman',
        'akhir_peminjaman',
        'users_id',
        'access_id',
        'status',
        'lama_peminjaman',
        'denda',
    ];

    public static function kode()
    {
        $id = self::latest()->first();
        return Carbon::now()->format('Ymd') . ($id->id ?? 0);
    }

    public static function onPengajuan($buku_id, $user_id)
    {
        $peminjaman = Peminjaman::where('buku_id', $buku_id)
            ->where('users_id', $user_id)
            ->first();
        if (!$peminjaman) {
            return false;
        } elseif (!$peminjaman->status && !$peminjaman->access_id && Carbon::now()->format('Y-m-d H:i:s') < $peminjaman->akhir_peminjaman) {
            return true;
        }
        return false;
    }

    public static function hasVerif($id, $user_id)
    {
        $peminjaman = Peminjaman::where('buku_id', $id)
            ->where('users_id', $user_id)
            ->latest()
            ->first();
        if (!$peminjaman) {
            return false;
        }
        if ($peminjaman->status && Carbon::now()->format('Y-m-d H:i:s') < $peminjaman->akhir_peminjaman) {
            return true;
        }
        return false;
    }

    public static function tertolak($buku_id, $user_id)
    {
        $peminjaman = Peminjaman::where('buku_id', $user_id)
            ->where('users_id', $user_id)
            ->first();
        if (!$peminjaman) {
            return false;
        } elseif ($peminjaman->access_id && Carbon::now()->format('Y-m-d H:i:s') > $peminjaman->akhir_peminjaman) {
            return true;
        }
        return false;
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
