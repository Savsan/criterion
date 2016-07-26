<?php

namespace App\Controllers\Companies;

use App\Controllers\Controller;
use App\Models\User;

class CompaniesController extends Controller
{
    public function getCompanies($request, $response){

        return $this->view->render($response, 'companies/companies.twig');

    }
    public function addCompany($request, $response){
        print_r($request->getParam('company_name')); die();
    }
}