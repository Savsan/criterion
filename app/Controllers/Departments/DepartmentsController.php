<?php

namespace App\Controllers\Departments;

use App\Controllers\Controller;

class DepartmentsController extends Controller
{
    public function getDepartments($request, $response){
        return $this->view->render($response, 'departments/departments.twig');
    }
}