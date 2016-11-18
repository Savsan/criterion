<?php

namespace App\Controllers\Departments;

use App\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use Respect\Validation\Validator as v;

class DepartmentsController extends Controller
{
    public function getDepartments($request, $response){
        return $this->view->render($response, 'departments/departments.twig');
    }    
    
    public function getAddDepartments($request, $response){
        $companies = Company::all();
        return $this->view->render($response, 'departments/add_departments.twig',[
            'companies' => $companies
        ]);
    }

    public function postAddDepartments($request, $response){

        $validation = $this->validator->validate($request, [

            'dep_name' => v::notEmpty(),
            'id_head_structure' => v::noWhitespace()->notEmpty()->intVal(),
            'date_create' => v::noWhitespace()->notEmpty(),
            'date_close' => v::noWhitespace()->notEmpty(),

        ]);

        if($validation->failed()){
            $this->container->flash->addMessage('danger', 'Ошибка. Вы не заполнили обязательные поля.');
            return $response->withRedirect($this->router->pathFor('departments.getAddDepartments'));
        }

        $department = Department::create([
            'department_name' => $request->getParam('dep_name'),
            'company_idcompany' => $request->getParam('id_head_structure'),
            'date_create' => $request->getParam('date_create'),
            'date_close' => $request->getParam('date_close'),
            'department_description' => $request->getParam('dep_description'),
        ]);

        $this->container->flash->addMessage('success', 'Подразделение успешно добавлено.');
        return $response->withRedirect($this->router->pathFor('departments.departments'));

    }

}