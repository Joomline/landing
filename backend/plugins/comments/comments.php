<?php

defined('_JEXEC') or die;

class plgLandingmanagementComments extends JPlugin
{
	protected $type;
	protected $title;

	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		$this->loadLanguage('plg_landingmanagement_comments');

		$this->type = 'comments';
		$this->title = JText::_('PLG_LANDINGMANAGEMENT_COMMENTS_TYPE');
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

		$name = $inputName;
		$values = isset($params['input']) ? json_decode($params['input'], true) : array();
		$order = !empty($values['order']) ? $values['order'] : 'ordering';
		$limit = !empty($values['limit']) ? $values['limit'] : '';
		$dirn = !empty($values['dirn']) ? $values['dirn'] : 'asc';

		$orderOptions = array(
			JHTML::_('select.option', 'random', 'Random'),
			JHTML::_('select.option', 'ordering', 'Ordering'),
			JHTML::_('select.option', 'date', 'Date')
		);
		$dirnOptions = array(
			JHTML::_('select.option', 'asc', 'ASC'),
			JHTML::_('select.option', 'desc', 'DESC')
		);

		JHtml::_('behavior.modal', 'a.modal');

		ob_start();
		require JPATH_ROOT.'/plugins/landingmanagement/'.$this->type.'/tpl/default.php';
		$html = ob_get_clean();
		$infoBlocks = $html;
	}
}
