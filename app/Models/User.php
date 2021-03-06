<?

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

	const ADMIN = "Админ";
	const HR_MANAGER = "HR-менеджер";
	const SIMPLE_USER = "Заказчик";
	
	protected $table = 'users';
	protected $primaryKey = 'idusers';
	public $timestamps = FALSE;
	
	protected $fillable = [
		'first_name',
		'last_name',
		'middle_name',
		'email',
		'password',
		'role',
		'company_idcompany',
	];

	public function company(){
		return $this->belongsTo('App\Models\Company', 'company_idcompany', 'idcompany');
	}
	
	public static function getUsers(){
		$users = self::all();
		return $users;
	}

	public static function deleteUser($request){
		$id = $request;
		self::where('idusers', '=', $id)->delete();
	}
}

?>