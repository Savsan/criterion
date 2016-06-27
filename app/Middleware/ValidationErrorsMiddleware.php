<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // A middleware
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        // Next, APP works
        $response = $next($request, $response);
        return $response;
    }
}