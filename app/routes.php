<?
//$app->get('/', 'HomeController:index')->setName('home');

use App\Middleware\AuthMiddleware;
use App\Middleware\AuthAdminMiddleware;
use App\Middleware\AuthHrManagerMiddleware;

// Public routs
$app->get('/', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/', 'AuthController:postSignIn');

/**
 * APP access control groups
 */

// Access only for Admin
$app->group('', function(){

    //USERS REGISTRATION
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');
    // COMPANY REGISTRATION CONTROLLERS
    $this->get('/companies', 'CompaniesController:getCompanies')->setName('companies.companies');
    $this->post('/companies', 'CompaniesController:postAddCompany');
    $this->get('/companies/delete/{id}', 'CompaniesController:deleteCompany');
    // USERS routers
    $this->get('/users', 'UsersController:Users')->setName('users.users');
    // SETTINGS routers
    $this->get('/settings', 'SettingsController:getSettings')->setName('settings.mainsettings');

})->add(new AuthAdminMiddleware($container));

// Access for users
$app->group('', function(){

    // ORDERS routers
    $this->get('/orders', 'OrdersController:getOrders')->setName('orders.orders');
    // CANDIDATES routers
    $this->get('/candidates', 'CandidatesController:getCandidates')->setName('candidates.candidates');
    // LOGOUT
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));

// Access for the HR manager and Admin
$app->group('', function(){

    // DASHBOARD routers
    $this->get('/dashboard', 'DashboardController:getDashboard')->setName('dashboard.dashboard');
    // DEPARTMENTS routers
    $this->get('/departments', 'DepartmentsController:getDepartments')->setName('departments.departments');
    $this->get('/departments/add', 'DepartmentsController:addDepartments')->setName('departments.addDepartments');
    // EMPLOYEES routers
    $this->get('/employees', 'EmployeesController:getEmployees')->setName('employees.employees');

})->add(new AuthHrManagerMiddleware($container));

?>