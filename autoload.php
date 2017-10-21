<?php
namespace Copyleaks;

// spl_autoload_register(__NAMESPACE__ . '\load');
function isJson($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}

/*
include_once( getcwd().'/CopyleaksCloud.php');
include_once( getcwd().'/LoginToken.php');
include_once( getcwd().'/CopyleaksProcess.php');
include_once( getcwd().'/API.php');

include_once( getcwd().'/Config.php');
include_once( getcwd().'/ErrorHandler.php');

*/



include_once( __DIR__.'/src/Components/CopyleaksCloud.php');
include_once( __DIR__.'/src/Components/LoginToken.php');
include_once( __DIR__.'/src/Components/CopyleaksProcess.php');
include_once( __DIR__.'/src/Components/API.php');

include_once( __DIR__.'/src/Helpers/Config.php');
include_once( __DIR__.'/src/Helpers/ErrorHandler.php');



?>