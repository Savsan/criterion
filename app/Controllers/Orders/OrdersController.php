<?php

namespace App\Controllers\Orders;

use App\Controllers\Controller;

class OrdersController extends Controller
{
    public function getOrders($request, $response){
        return $this->view->render($response, 'orders/orders.twig');
    }
}