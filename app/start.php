<?
use Respect\Validation\Validator as v;

session_cache_limiter(false);
session_start();
ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));
require INC_ROOT . "/vendor/autoload.php";

/* Create and connect a configuration */
include 'config.php';
$app = new \Slim\App($configuration);

/* Get an APP container */
$container = $app->getContainer();

/* Set illuminate database namespace */
use Illuminate\Database\Capsule\Manager as Capsule;

/* Create database object and set option */
$capsule = new Capsule;
$capsule->addConnection($container['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

/* Register database/Eloquent methods into container */
$container['db'] = function ($container) use ($capsule){
	return $capsule;
};

$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};

/* Register components into TWIG container */
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(INC_ROOT . "/resources/views", [
        // default -'path/to/cache'
		'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    // Add an auth check for view control
    $view->getEnvironment()->addGlobal('auth', [

        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
        'simpleuser' => $container->auth->checkIsSimpleUser(),
        'admin' => $container->auth->checkIsAdmin(),
        'hrmanager' => $container->auth->checkIsHrManager(),

    ]);
    $view->getEnvironment()->addGlobal('current', [

        'year' => date("Y"),

    ]);
    // Add a flash messages
    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};


/******************************
**	Controllers registration **
******************************/

$container['validator'] = function ($container) {
    return new \App\Validation\Validator;
	};

/*$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
	};*/

$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
	};

$container['CompaniesController'] = function ($container) {
    return new App\Controllers\Companies\CompaniesController($container);
};

$container['UsersController'] = function ($container) {
    return new App\Controllers\Users\UsersController($container);
};

$container['SettingsController'] = function ($container) {
    return new App\Controllers\Settings\SettingsController($container);
};

$container['DashboardController'] = function ($container) {
    return new App\Controllers\Dashboard\DashboardController($container);
};

$container['OrdersController'] = function ($container) {
    return new App\Controllers\Orders\OrdersController($container);
};

$container['CandidatesController'] = function ($container) {
    return new App\Controllers\Candidates\CandidatesController($container);
};

$container['DepartmentsController'] = function ($container) {
    return new App\Controllers\Departments\DepartmentsController($container);
};

$container['EmployeesController'] = function ($container) {
    return new App\Controllers\Employees\EmployeesController($container);
};

$container['CalculateController'] = function ($container) {
    return new \App\Controllers\CalculateController($container);
    };

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
   };

$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldInputMiddleware($container));
$app->add(new App\Middleware\CsrfViewMiddleware($container));

$app->add($container->get('csrf'));

v::with('App\\Validation\\Rules\\');

require 'routes.php';

?>