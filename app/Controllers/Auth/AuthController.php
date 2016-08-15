<?

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Respect\Validation\Validator as v;

class AuthController extends Controller{

	public function getSignOut($request, $response)
	{
		$this->auth->logOut();
		return $response->withRedirect($this->router->pathFor('auth.signin'));
	}

	public function getSignIn($request, $response)
	{
		return $this->view->render($response, 'index.twig');
	}

	public function postSignIn($request, $response)
	{
		$validation = $this->validator->validate($request, [
			
			'email' => v::noWhitespace()->notEmpty(),
			'password' => v::noWhitespace()->notEmpty(),

		]);

		if($validation->failed()){

			return $response->withRedirect($this->router->pathFor('auth.signin'));

		}

		$auth = $this->auth->attempt($request->getParam('email'), $request->getParam('password'));

		if(!$auth){
			$this->container->flash->addMessage('loginerror', 'Неправильно указан логин или пароль');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		if($this->container->auth->checkIsSimpleUser()){
			return $response->withRedirect($this->router->pathFor('orders.orders'));
		}

		return $response->withRedirect($this->router->pathFor('dashboard.dashboard'));
	}

	public function getSignUp($request, $response)
	{
		$companies = Company::all();
		return $this->view->render($response, 'auth/signup.twig', [
			'companies' => $companies,
		]);
	}

	public function postSignUp($request, $response)
	{

		$validation = $this->validator->validate($request, [

			'first_name' => v::notEmpty(),
			'last_name' => v::notEmpty(),
			'middle_name' => v::notEmpty(),
			'email' => v::noWhitespace()->notEmpty()->EmailAvailible(),
			'password' => v::noWhitespace()->notEmpty(),
			'role' => v::noWhitespace()->notEmpty(),
			'users_company' => v::noWhitespace()->notEmpty(),

		]);

		if($validation->failed()){
			return $response->withRedirect($this->router->pathFor('auth.signup'));

		}

		$user = User::create([
			'first_name' => $request->getParam('first_name'),
			'last_name' => $request->getParam('last_name'),
			'middle_name' => $request->getParam('middle_name'),
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			'role' => $request->getParam('role'),
			'company_idcompany' => $request->getParam('users_company'),
		]);
		$this->container->flash->addMessage('usercreated', 'Пользователь успешно создан !');
		return $response->withRedirect($this->router->pathFor('users.users'));
		
	}
	
}

?>