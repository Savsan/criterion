<?php

namespace App\Controllers\Departments;

use App\Controllers\Controller;

class DepartmentsController extends Controller
{
    public function getDepartments($request, $response){
        return $this->view->render($response, 'departments/departments.twig');
    }    
    
    public function addDepartments($request, $response){
        return $this->view->render($response, 'departments/add_departments.twig');
    }
}