<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjekBuku extends Model
{
    use HasFactory;

    protected $table = 'subjek_buku';
    protected $fillable = [
        'buku_id',
        'subjek_id'
    ];

    public function subjek()
    {
        return $this->belongsTo(Subjek::class, 'subjek_id', 'id');
    }
}
