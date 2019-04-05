<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
class JFormFieldPluginInput extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'PluginInput';

	/**
	 * Method to get the field input markup.
	 * The checked element sets the field to selected.
	 *
	 * @return  string   The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{


		$type = LandingmanagementHelper::getBlockType();

		if(empty($type)){
			JError::raiseError( 500, JText::_('COM_LANDINGMANAGEMENT_EMPTY_TYPE') );
			return;
		}
		if(!JPluginHelper::isEnabled('landingmanagement', $type)){
			JError::raiseError( 500, JText::_('COM_LANDINGMANAGEMENT_NOT_ENABLE_TYPE') );
			return;
		}
		JPluginHelper::importPlugin('landingmanagement', $type);
		$dispatcher = JDispatcher::getInstance();
		$block = array();
		$block["type"] = $type;
		$block["input"] = $this->value;
		$html = '';
		$dispatcher->trigger('onPrepareLandingTypeBlocks',array(&$html, $this->name, $block));
		return $html;
	}


}
