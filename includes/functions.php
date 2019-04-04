<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

ini_set('display_errors','On');
error_reporting('E_ALL');

// autoload function
function __autoload($class)
{
	// convert namespace to full file path
	$class = str_replace('\\', '/', $class);
	if(strpos($class,'/') !== 0){
		$class = '/'.$class;
	}
	$class = 'classes' . $class . '.php';

	if(!is_file($class)){
		throw new Exception('File '.$class.' not found', 500);
		return;
	}
	require_once($class);
}