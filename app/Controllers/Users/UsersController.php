<?php

namespace App\Controllers\Users;

use App\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function Users($request, $response){

        if(!empty($request->getParam('delete'))){
            User::deleteUser($request->getParam('delete'));
            $users = User::getUsers();
            return $this->view->render($response, 'users/users.twig', [
                'users' => $users,
            ]);
        }else{
            $users = User::getUsers();
            return $this->view->render($response, 'users/users.twig', [
                'users' => $users,
            ]);
        }

    }
}