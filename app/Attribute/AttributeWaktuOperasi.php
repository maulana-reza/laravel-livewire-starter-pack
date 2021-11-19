<?php


namespace App\Attribute;


use App\Models\WaktuOperasi;

trait AttributeWaktuOperasi
{
    public $hari_mulai,
        $hari_akhir,
        $jam_mulai,
        $jam_akhir,
        $istirahat_mulai,
        $istirahat_akhir;

    public function mountWaktuOperasi($waktu)
    {
        if ($waktu) {
            foreach ((new WaktuOperasi())->getFillable() as $item) {
                if (!in_array($item, [])) $this->{$item} = $waktu->{$item};
            }
        }

    }

}
