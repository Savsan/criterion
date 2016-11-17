<?php

namespace App\Middleware;


class AuthAdminMiddleware extends Middleware
{
    public function __invoke($request, $response, $next){
        // Middleware
        if(!$this->container->auth->checkIsAdmin()){
            $this->container->flash->addMessage('danger', 'У вас нет прав Администратора');
            return $response->withRedirect($this->container->router->pathFor('dashboard.dashboard'));
        }

        // Next, APP works
        $response = $next($request, $response);
        return $response;

    }

}