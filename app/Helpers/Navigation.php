<?php


namespace App\Helpers;


use Illuminate\Support\Arr;

class Navigation
{

    /**
     * Menu
     * Roles => [route name => label menu]
     */
    static protected $menus = [
        'default' => [
        ],
        'super-admin' => [
            'dashboard' => 'dashboard',
            'user.list' => 'users',
            'setting.list' => 'Pengaturan',
            'datamaster.list' => 'DataMaster',
            'buku.list' => 'Buku',
            'artikel.list' => 'Berita'
        ],
        'general' => [
            'general.buku.list' => 'Buku'
        ],
        'no-login' => [
            'home' => 'Home',
            'default.artikel.list' => 'Berita Perpustakaan',
            'default.buku.list' => 'Buku',
        ],
        'pustakawan' => [
            'pustakawan.buku.verify' => 'Verifikasi Peminjaman'
        ],
    ];

    static public function get()
    {
        $data = auth()->user()->getRoleNames()->toArray();
        $result = [];
        foreach (self::$menus as $key => $item) {
            $isAccessible = array_search($key, $data);
            if ($isAccessible >= -1 || $key === "default") {
                $result = Arr::collapse([$result, $item]);
            }
        }
        return $result;
    }
    static public function getDefault()
    {
        return self::$menus['no-login'];

    }
}
