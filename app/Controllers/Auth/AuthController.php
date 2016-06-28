<?

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
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
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('dashboard.dashboard'));
	}

	public function getSignUp($request, $response)
	{
		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignUp($request, $response)
	{
		
		$validation = $this->validator->validate($request, [

			'name' => v::notEmpty()->alpha(),
			'email' => v::noWhitespace()->notEmpty()->EmailAvailible(),
			'password' => v::noWhitespace()->notEmpty(),
			'role' => v::noWhitespace()->notEmpty(),

		]);

		if($validation->failed()){

			return $response->withRedirect($this->router->pathFor('auth.signup'));

		}

		$user = User::create([
			'name' => $request->getParam('name'),
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			'role' => $request->getParam('role'),
		]);
		
		return $response->withRedirect($this->router->pathFor('home'));
		
	}
	
}

?>