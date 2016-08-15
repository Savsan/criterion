<?

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

	const ADMIN = "Админ";
	const HR_MANAGER = "HR-менеджер";
	const SIMPLE_USER = "Заказчик";
	
	protected $table = 'users';
	protected $primaryKey = 'idusers';
	
	protected $fillable = [
		'first_name',
		'last_name',
		'middle_name',
		'email',
		'password',
		'role',
		'company_idcompany',
	];
	
	public static function getUsers(){
		$users = self::all();
		return $users;
	}

	public static function deleteUser($request){
		$id = $request;
		self::where('id', '=', $id)->delete();
	}
}

?>