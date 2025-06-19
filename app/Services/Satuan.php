<?php

namespace App\Services;

use App\Models\Satuan as ModelsSatuan;

class Satuan
{
    protected $satuanModel;
    public function __construct()
    {
        $this->satuanModel = new ModelsSatuan();
    }
}
