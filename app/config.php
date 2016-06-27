<?

$configuration = [
		
	'settings' => [
		'displayErrorDetails' => true
	],
	
	/* Primary APP config */
	'app' => [
		'url' => 'http://slim/',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		]
	],
	
	/* APP's eloquent databse config */
	'db' => [
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'database' => 'dbslim',
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'collation' => 'utf8_general_ci',
		'prefix' => ''
	],
	
	/* An e-mail settings configuration */
	/*'mail' => [
		'smtp_auth' => true,
		'smtp_secure' => 'tls',
		'host' => 'smtp.gmail.com',
		'username' => 'vorove.pro@gmail.com',
		'password' => 'ilovec4ts',
		'port' => 587,
		'html' => 'tls',
	],*/
	
	/* Twig's settings config */
	'twig' => [
		'debug' => true		
	],
];

?>