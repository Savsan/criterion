<?php

namespace App\Controllers\Users;

use App\Controllers\Controller;

class UsersController extends Controller
{
    public function getUsers($request, $response){
        return $this->view->render($response, 'users/users.twig');
    }
}