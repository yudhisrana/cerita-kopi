<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Satuan as ServicesSatuan;
use CodeIgniter\HTTP\ResponseInterface;

class Satuan extends BaseController
{
    protected $satuanService;
    public function __construct()
    {
        $this->satuanService = new ServicesSatuan();
    }

    public function index()
    {
        //
    }
}
