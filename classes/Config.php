<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class Config{
	private
		$db = '',
		$dbuser = '',
		$dbpassword = '',
		$dbprefix = '',
		$dbhost = 'localhost',
		$mainsite = '',
		$landingId,
		$template,
		$site_email = ''
	;

	public function __construct()
    {
        $data = Helper::getSiteInfo($this);
        $this->landingId = $data['id'];
        $this->template = $data['template'];
    }

    public function get($varname, $default=null)
    {
		return isset( $this->$varname ) ? $this->$varname : $default;
	}
}
