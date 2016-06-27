<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboard($request, $response){
        return $this->view->render($response, 'dashboard/dashboard.twig');
    }
}