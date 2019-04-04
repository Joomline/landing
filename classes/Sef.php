<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class Sef{


	public function parseRoute()
    {
        $ds = DIRECTORY_SEPARATOR;
        $uri = $_SERVER["REQUEST_URI"];
        $uri = trim($uri, $ds);
        $parts = explode('?', $uri);
        $parts = $parts[0];
        $parts = explode($ds, $parts);
        if(!empty($parts[0])){
            $view = array_shift($parts);
            $_REQUEST['menu_alias'] = $_GET['menu_alias'] = $view;
            if(count($parts) > 0){
                foreach ($parts as $k => $part) {
                    $_REQUEST['arg'.($k+1)] = $_GET['arg'.($k+1)] = $part;
                }
            }
        }
	}
}