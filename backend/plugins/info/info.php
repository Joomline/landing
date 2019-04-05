<?php

defined('_JEXEC') or die;

class plgLandingmanagementInfo extends JPlugin
{
	protected $type;
	protected $title;

	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		$this->loadLanguage('plg_landingmanagement_info');

		$this->type = 'info';
		$this->title = JText::_('PLG_LANDINGMANAGEMENT_INFO_TYPE');
	}

	public function onPrepareLandingTypeOptions(&$options)
	{
		$options[] = JHTML::_('select.option', $this->type, $this->title);
	}

	public function onPrepareLandingTypeBlocks(&$infoBlocks, $inputName, $params)
	{
		if($params["type"] != $this->type){
			return;
		}

		$value = !empty($params['input']) ? $params['input'] : '';
		$title = $this->title;
		$editor = JFactory::getEditor();
		$inputId = str_replace(array('[', ']'), array('-', ''), $inputName);
		$editor =$editor->display( $inputName, htmlspecialchars($value, ENT_COMPAT, 'UTF-8'),
			'100%', '200', '30', '5',
			true, $inputId.'-input', ''
			);
		ob_start();
		require JPATH_ROOT.'/plugins/landingmanagement/'.$this->type.'/tpl/default.php';
		$html = ob_get_clean();

		$infoBlocks = $html;
	}
}
