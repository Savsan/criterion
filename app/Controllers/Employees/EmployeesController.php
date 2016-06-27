<?php

namespace App\Controllers\Employees;

use App\Controllers\Controller;

class EmployeesController extends Controller
{
    public function getEmployees($request, $response){
        return $this->view->render($response, 'employees/employees.twig');
    }
}