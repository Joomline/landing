<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace views;

class Notfound extends Main
{
	public function __construct($data, $config)
	{
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		parent::__construct($data, $config);
		$this->text = 'Error 404. Page not found';
		$this->template = 'notfound';
	}
}