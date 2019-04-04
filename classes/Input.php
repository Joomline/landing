<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class Input
{
	function getString($name, $default=null){
		$data = isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
		return (string)filter_var($data, FILTER_SANITIZE_STRING);
	}

	function getInt($name, $default=null){
		$data = isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
		return (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
	}

	function getFloat($name, $default=null){
		$data = isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
		return (float)filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);
	}
}