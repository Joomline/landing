<?php

defined( '_JEXEC' ) or die;

/**
 * Class LandingmanagementHelper
 */
class LandingmanagementHelper
{
	/**
	 * Добавление подменю
	 * @param String $vName
	 */
	static function addSubmenu( $vName )
	{
		JHtmlSidebar::addEntry(
			JText::_( 'SITE_SUBMENU' ),
			'index.php?option=com_landingmanagement&view=sites',
			$vName == 'sites' );
		JHtmlSidebar::addEntry(
			JText::_( 'COMMENT_SUBMENU' ),
			'index.php?option=com_landingmanagement&view=comments',
			$vName == 'comments' );
		JHtmlSidebar::addEntry(
			JText::_( 'BLOCK_SUBMENU' ),
			'index.php?option=com_landingmanagement&view=blocks',
			$vName == 'blocks' );
		JHtmlSidebar::addEntry(
			JText::_( 'PAGE_SUBMENU' ),
			'index.php?option=com_landingmanagement&view=pages',
			$vName == 'pages' );
	}

	/**
	 * Получаем доступные действия для текущего пользователя
	 * @return JObject
	 */
	public static function getActions()
	{
		$user = JFactory::getUser();
		$result = new JObject;
		$assetName = 'com_landingmanagement';
		$actions = JAccess::getActions( $assetName );
		foreach ( $actions as $action ) {
			$result->set( $action->name, $user->authorise( $action->name, $assetName ) );
		}
		return $result;
	}

	public static function getTypeOptions(){
		JPluginHelper::importPlugin('landingmanagement');
		$dispatcher = JDispatcher::getInstance();
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('COM_LANDINGMANAGEMENT_SELECT_TYPE'));
		$dispatcher->trigger('onPrepareLandingTypeOptions',array(&$options));
		return $options;
	}

	public static function getSiteOptions(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id AS value, title AS text')->from('#__landingmanagement_sites')->order('title');
		$options = array(JHtml::_('select.option', '0', JText::_('COM_LANDINGMANAGEMENT_SELECT_SITE')));
		$options2 = $db->setQuery($query)->loadObjectList();
		$options = array_merge($options, $options2);
		return $options;
	}

	public static  function getBlockType()
	{
		$app = JFactory::getApplication();
		$id = (int)$app->input->getInt('id', 0);
		$type = $app->input->getString('type', '');
		if($type == '' && $id != 0){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('type')->from('#__landingmanagement_blocks')->where('id = '.(int)$id);
			$type = $db->setQuery($query,0,1)->loadResult();
		}
		return $type;
	}

	public static  function getTypesArray()
	{
		JPluginHelper::importPlugin('landingmanagement');
		$dispatcher = JDispatcher::getInstance();
		$options = array();
		$dispatcher->trigger('onPrepareLandingTypeOptions',array(&$options));
		$array = array();
		foreach ( $options as $option ) {
			$array[$option->value] = $option->text;
		}
		return $array;
	}


	public static function getSitesArray(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id AS value, title AS text')->from('#__landingmanagement_sites')->order('title');
		$options = $db->setQuery($query)->loadObjectList();
		$array = array();
		if(count($options)){
			foreach ( $options as $option ) {
				$array[$option->value] = $option->text;
			}
		}
		return $array;
	}
}