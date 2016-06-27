<?php

namespace App\Middleware;

class OldInputMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // A middleware
        $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        $_SESSION['old'] = $request->getParams();


        // Next, APP works
        $response = $next($request, $response);
        return $response;
    }
}