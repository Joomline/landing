<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class Helper {
	private static $config;
	public static function prepareImage($image){
		$rootUrl = self::getConfig()->get('mainsite');
		if(strpos($image, 'http') === 0 || strpos($image, '/') === 0){
			return $image;
		}
		else{
			return $rootUrl.$image;
		}
	}

	private static function getConfig(){
		if(!(self::$config instanceof Config)){
			self::$config = new Config();
		}
		return self::$config;
	}

	public static function getSiteInfo(\Config $config){
        $domain = $_SERVER['HTTP_HOST'];
        $opts = array(
            'user' => $config->get( 'dbuser' ),
            'pass' => $config->get( 'dbpassword' ),
            'db' => $config->get( 'db' ),
            'host' => $config->get( 'dbhost' ),
            'prefix' => $config->get( 'dbprefix' )
        );
	    $db = new \SafeMySQL( $opts );
        $data = $db->getRow("SELECT * FROM `#__landingmanagement_sites` WHERE domain=?s", $domain);
        $data['id'] = empty($data['id']) ? 0 : (int)$data['id'];
        $data['template'] = empty($data['template']) ? 'default' : $data['template'];
        return $data;
    }
}
