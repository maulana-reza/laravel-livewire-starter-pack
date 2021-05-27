<?php


namespace App\Repository\SuperAdmin\DataMaster;


interface DataMasterInterface
{
    public function save();
    public function edit(int $id);
    public function remove(int $id);

}
