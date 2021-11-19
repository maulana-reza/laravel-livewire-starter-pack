<?php

namespace App\Http\Middleware;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class HasPinjamBook
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole(['general'])) {
            $peminjaman = Peminjaman::where('buku_id', $request->buku_id)
                ->where('users_id', auth()->user()->getAuthIdentifier())
                ->first();
            if (!$peminjaman) {
                return $next($request);
            }
            if ($peminjaman && $peminjaman->access_id && Carbon::now()->format('Y-m-d H:i:s') < $peminjaman->akhir_peminjaman) {
                $request->session()->flash('status', 'Buku Sedang dalam peminjaman');
                return $next($request);
            } elseif ($peminjaman && !$peminjaman->access_id && Carbon::now()->format('Y-m-d H:i:s') < $peminjaman->akhir_peminjaman) {
                $request->session()->flash('status', 'Buku Sedang dalam pengajuan peminjaman');
                return $next($request);
            }
        }
        return $next($request);
    }
}
