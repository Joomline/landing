<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace adapters;

class Info extends Main
{
	function __construct( \Config $config, $template ) {
		parent::__construct( $config, $template );
		$this->type = 'info';
	}

	public function show($block, $i, $view, &$params)
	{
		$this->type = $block['type'];
		$this->id = $block['alias'];
		$this->title = $block['title'];
		$this->input = $block['input'];

		$this->loadTpl();
	}
}