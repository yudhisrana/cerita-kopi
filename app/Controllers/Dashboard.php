<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Dashboard as ServicesDashboard;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $dashboardService;
    public function __construct()
    {
        $this->dashboardService = new ServicesDashboard();
    }
    public function index()
    {
        $dashboardSummary = $this->dashboardService->getDashboardSummary();

        $data = [
            'page'              => 'dashboard',
            'title'             => 'Cerita Kopi - Dashboard',
            'dashboard_summary' => $dashboardSummary,
        ];
        return view('dashboard', $data);
    }
}
