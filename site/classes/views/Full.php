<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace views;

class Full extends Main{
	public function __construct($data, $config)
	{
		parent::__construct($data, $config);

		$this->view = 'full';
		$this->text = '';
	}
}