<?php

defined('_JEXEC') or die;

class plgLandingmanagementFeedback extends JPlugin
{
	protected $type;
	protected $title;

	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		$this->loadLanguage('plg_landingmanagement_feedback');

		$this->type = 'feedback';
		$this->title = JText::_('PLG_LANDINGMANAGEMENT_FEEDBACK_TYPE');
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

		$value = !empty($params['input']) ? json_decode($params['input'], true) : array();
		$name = $inputName;

		ob_start();
		require JPATH_ROOT.'/plugins/landingmanagement/'.$this->type.'/tpl/default.php';
		$html = ob_get_clean();
		$infoBlocks = $html;
	}
}
