<?php

	define( 'BASE_PATH', dirname(__FILE__).'/' );
	define( 'UPLOADS_PATH', BASE_PATH.'www/uploads/' );
	mb_internal_encoding('UTF-8'); # if you still use old encodings, go outside now and reflect upon your evildoing

	require_once 'dao/index.php';
	require_once 'lib/smarty.php';
	require_once 'lib/upload.php';

?>
