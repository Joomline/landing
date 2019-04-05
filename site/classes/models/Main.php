<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace models;

class Main {
	protected $config, $db, $landingId;

	public function __construct( \Config $config ) {
		$this->config = $config;
		$opts = array(
			'user' => $config->get( 'dbuser' ),
			'pass' => $config->get( 'dbpassword' ),
			'db' => $config->get( 'db' ),
			'host' => $config->get( 'dbhost' ),
			'prefix' => $config->get( 'dbprefix' )
		);
		$this->db = new \SafeMySQL( $opts );
		$this->landingId = $this->config->get( 'landingId' );
	}

	public function getSiteData($path)
	{
		$path = trim($path, "\\/");
		$data = $this->db->getRow("SELECT * FROM `#__landingmanagement_sites` WHERE id=?i", $this->landingId);
		$blocks = $this->getBlocks();
		$pages = $this->getPages();
		$data['blocks'] = $data['menu'] = array();
		$enabledBlocks = $this->prepareBlocks($data['main_blocks']);

		foreach ($blocks as $block)
		{
			if(isset($enabledBlocks[$block['alias']]) && !empty($block['menu_title'])){
				$data['menu'][] = array('title' => $block['menu_title'], 'link' => '/#'.$block['alias']);
			}
		}

		foreach ( $pages as $page )
		{
			$data['menu'][] = array('title' => $page['title'], 'link' => '/'.$page['alias']);
		}

		if(isset($pages[$path])){
			$page = $pages[$path];
			if(!empty($page['metatitle'])){
				$data['metatitle'] = $page['metatitle'];
			}
			if(!empty($page['metadesc'])){
				$data['metadesc'] = $page['metadesc'];
			}
			$data['title'] = $page['title'];
			$enabledBlocks = $this->prepareBlocks($page['blocks']);
		}
		 else if(!in_array($path, array('', '/'))){
			 $enabledBlocks = array();
		}

		if(count($enabledBlocks) == 0){
			$data['blocks'] = array();
		}
		else{
			foreach ($blocks as $block)
			{
				if(!isset($enabledBlocks[$block['alias']])) continue;
				$enabledBlocks[$block['alias']] = $block;
			}

			foreach ($enabledBlocks as $k => $v)
			{
				if(!count($v)) unset($enabledBlocks[$k]);
			}

			$data['blocks'] = $enabledBlocks;
		}

		$data['abstract'] = json_decode($data['abstract'], true);
		return $data;
	}

	private function prepareBlocks($raw){
		$data = explode(',', $raw);
		$data = array_map('trim', $data);
		$array = array();
		foreach ($data as $v){
			$array[$v] = array();
		}
		return $array;
	}

	private function getBlocks(){
		if(empty($this->landingId)){
			return array();
		}

		$data = $this->db->getInd(
			'alias',
			"SELECT `id`, `title`, `alias`, `menu_title`, `input`, `type`  FROM `#__landingmanagement_blocks` "
		  . "WHERE `published`=1 AND `site_id`=?i ORDER BY ordering",
			$this->landingId
		);

		if(!is_array($data)){
			$data = array();
		}
		return $data;
	}

	private function getPages(){
		if(empty($this->landingId)){
			return array();
		}

		$data = $this->db->getInd(
			'alias',
			"SELECT `id`, `title`, `alias`, `metatitle`, `metadesc`, `blocks` FROM `#__landingmanagement_pages` "
		  . "WHERE `published`=1 AND `site_id`=?i ORDER BY ordering",
			$this->landingId
		);

		if(!is_array($data)){
			$data = array();
		}
		return $data;
	}
}