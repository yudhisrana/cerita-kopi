<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Cerita Kopi - Kasir',
        ];
        return view('kasir', $data);
    }
}
