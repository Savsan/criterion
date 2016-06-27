<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 26.06.2016
 * Time: 5:05
 */

namespace App\Middleware;


class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next){
        // Middleware
        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('error', 'Вы не выполнили вход в систему, пожалуйста, авторизируйтесь');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        // Next, APP works
        $response = $next($request, $response);
        return $response;

    }

}