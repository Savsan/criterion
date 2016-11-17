<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next){
        // Middleware
        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('danger', 'Вы не выполнили вход в систему, пожалуйста, авторизируйтесь');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        // Next, APP works
        $response = $next($request, $response);
        return $response;

    }

}