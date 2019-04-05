<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace controllers;

class Main
{
	protected $config, $model, $input, $viewName;

	public function __construct(\Config $config) {
		$this->config = $config;
		$this->model = new \models\Main($config);
		$this->input = new \Input();
		$this->viewName = 'main';
	}

	public function execute()
	{
		$adapter = $this->input->getString('adapter');
		$task = $this->input->getString('task');

		if(empty($adapter) || empty($task)){
			$this->show();
			return;
		}
		$adapterName = "\\adapters\\".ucfirst($adapter);

		$oAdapter = new $adapterName($this->config, $this->viewName);

		if(method_exists($oAdapter, $task)){
			$oAdapter->$task();
		}
	}

	function show(){
        $path = '/'.$this->input->getString('menu_alias');

		try {
			$siteData = $this->model->getSiteData($path);

			if(!count($siteData['blocks'])){
				$this->viewName = 'notfound';
			}
			else if(in_array($path, array('', '/'))){
				$this->viewName = 'main';
			}
			else{
				$this->viewName = 'full';
			}
			$viewName = "\\views\\".ucfirst($this->viewName);
			$view = new $viewName($siteData, $this->config);
			$view->show();
		}
		catch (\Exception $e) {
			echo 'Ошибка: ',  $e->getMessage(), "\n";
		}
	}
}