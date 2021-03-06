<?php

namespace App\Controllers\Companies;

use App\Controllers\Controller;
use App\Models\Company;
use Respect\Validation\Validator as v;

class CompaniesController extends Controller
{
    public function getCompanies($request, $response){
        
        $companies = Company::all();

        $i = 0;
        foreach($companies as $company){
            $companies[$i++]['employees'] = $company->find($company->idcompany)->users->count();
        }

        return $this->view->render($response, 'companies/companies.twig', [
            'companies' => $companies,
        ]);

    }

    public function postAddCompany($request, $response){

        $validation = $this->validator->validate($request, [
            
            'company_name' => v::notEmpty(),

        ]);

        if($validation->failed()){
            $this->container->flash->addMessage('danger', 'Компания не создана. Введите название.');
            return $response->withRedirect($this->router->pathFor('companies.companies'));
        }

        $user = Company::create([
            'company_name' => $request->getParam('company_name'),
        ]);
        $this->container->flash->addMessage('success', 'Компания успешно добавлена.');
        return $response->withRedirect($this->router->pathFor('companies.companies'));

    }
    
    public function deleteCompany($request, $response, $args){
        Company::deleteCompany($args);
        $this->container->flash->addMessage('success', 'Компания была успешно удалена.');
        return $response->withRedirect($this->router->pathFor('companies.companies'));
    }
}