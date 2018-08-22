<?php
		$protocol = 'http';
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
		{
			$protocol = 'https';
		}
		define('URL', $protocol.'://'.$_SERVER['HTTP_HOST'].'/');
		define('SITE','/');
		define('DB_NAME','');
		define('DB_PASS','');
		define('DB_HOST','');
		define('DB_USER','');
		define('ADMIN_EMAIL','');