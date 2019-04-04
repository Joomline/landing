<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace adapters;

class Main
{
	public static $scripts, $scriptDeclaration, $siteData;
	protected
		$config,
		$template,
		$type,
		$id,
		$title,
		$input
	;

	function __construct(\Config $config, $template) {
		$this->config = $config;
		$this->template = $template;
	}

	protected function loadTpl($add=''){
		$tpl = 'template/'.$this->config->get('template').'/adapters/'.$this->type.$add.'.php';
		if(is_file($tpl)){
			require $tpl;
		}
	}

	protected function addScript($src)
	{
		if(!is_array(self::$scripts)){
			self::$scripts = array($src => $src);
		}
		else{
			self::$scripts[$src] = $src;
		}
	}

	protected function addScriptDeclaration($script)
	{
		self::$scriptDeclaration .= "\n\n".$script;
	}

	function getData(){
		if(!empty(self::$siteData)){
			return self::$siteData;
		}
		$model = new \models\Main($this->config);
		self::$siteData = $model->getSiteData('');
		return self::$siteData;
	}
}