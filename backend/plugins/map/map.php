<?php

defined('_JEXEC') or die;

class plgLandingmanagementMap extends JPlugin
{
	protected $type;
	protected $title;

	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		$this->loadLanguage('plg_landingmanagement_map');

		$this->type = 'map';
		$this->title = JText::_('PLG_LANDINGMANAGEMENT_MAP_TYPE');
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
		$doc = JFactory::getDocument();
		$doc->addScript(JUri::root().'plugins/landingmanagement/map/assets/js/map.js');
		$values = !empty($params['input']) ? json_decode($params['input'], true) : array();
		$center_lat = !empty($values['center_lat']) ? $values['center_lat'] : '';
		$center_lng = !empty($values['center_lng']) ? $values['center_lng'] : '';
		$zoom = !empty($values['zoom']) ? $values['zoom'] : '';
		$cities = !empty($values['cities']) ? $values['cities'] : '';
		$points = !empty($values['points']) && is_array($values['points']) && count($values['points']) ? $values['points'] : array();
		$name = $inputName;

		ob_start();
		require JPATH_ROOT.'/plugins/landingmanagement/'.$this->type.'/tpl/default.php';
		$html = ob_get_clean();
		$infoBlocks = $html;
	}
}
