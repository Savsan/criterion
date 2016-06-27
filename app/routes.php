<?
//$app->get('/', 'HomeController:index')->setName('home');

use App\Middleware\AuthMiddleware;

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');

$app->get('/', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/', 'AuthController:postSignIn');

/**
 * APP access control group
 */
$app->group('', function(){

    //$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    // USERS routers
    //$this->get('/users', 'UsersController:getUsers')->setName('users.users');

    // SETTINGS routers
    //$this->get('/settings', 'SettingsController:getSettings')->setName('settings.mainsettings');

    // DASHBOARD routers
    //$this->get('/dashboard', 'DashboardController:getDashboard')->setName('dashboard.dashboard');

    // ORDERS routers
    //$this->get('/orders', 'OrdersController:getOrders')->setName('orders.orders');

    // CANDIDATES routers
    //$this->get('/candidates', 'CandidatesController:getCandidates')->setName('candidates.candidates');

    // DEPARTMENTS routers
    //$this->get('/departments', 'DepartmentsController:getDepartments')->setName('departments.departments');

    // EMPLOYEES routers
    //$this->get('/employees', 'EmployeesController:getEmployees')->setName('employees.employees');

    // CALCULATOR routers
    //$this->get('/calculate', 'CalculateController:getCalculate')->setName('calculate.averagefuelcalc');
    //$this->post('/calculate', 'CalculateController:postCalculate');

})->add(new AuthMiddleware($container));

/**
 * Temporary FREE access
 */
$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

// USERS routers
$app->get('/users', 'UsersController:getUsers')->setName('users.users');

// SETTINGS routers
$app->get('/settings', 'SettingsController:getSettings')->setName('settings.mainsettings');

// DASHBOARD routers
$app->get('/dashboard', 'DashboardController:getDashboard')->setName('dashboard.dashboard');

// ORDERS routers
$app->get('/orders', 'OrdersController:getOrders')->setName('orders.orders');

// CANDIDATES routers
$app->get('/candidates', 'CandidatesController:getCandidates')->setName('candidates.candidates');

// DEPARTMENTS routers
$app->get('/departments', 'DepartmentsController:getDepartments')->setName('departments.departments');

// EMPLOYEES routers
$app->get('/employees', 'EmployeesController:getEmployees')->setName('employees.employees');

?>