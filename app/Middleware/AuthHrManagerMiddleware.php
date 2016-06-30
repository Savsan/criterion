<?php

namespace App\Middleware;


class AuthHrManagerMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // Middleware
        if(!$this->container->auth->checkIsHrManager() and !$this->container->auth->checkIsAdmin()){
            $this->container->flash->addMessage('nothrmanagererror', 'У вас нет прав HR-менеджера');
            return $response->withRedirect($this->container->router->pathFor('orders.orders'));
        }

        // Next, APP works
        $response = $next($request, $response);
        return $response;
    }
}