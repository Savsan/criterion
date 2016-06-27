<?

namespace App\Controllers;

class HomeController extends Controller{
	
	public function index($request, $response){
		
		/* $user = $this->db->table('users')->find(0);
		echo "<pre>";
		var_dump($user->username);
		die(); */
		
		return $this->view->render($response, 'index.twig');
		
		
		// return "It's a HOMECONTROLLER'S WORK !!!";
	}
	
}

?>