<?php
// No direct access
defined( 'JPATH_BASE' ) or die;

/**
 * Field for display view item
 * @author Joomline
 */
class JFormFieldModal_Site extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var      string
	 * @since    1.6
	 */
	protected $type = 'Modal_Site';

	/**
	 * Method to get the field input markup.
	 *
	 * @return    string    The field input markup.
	 * @since    1.6
	 */
	protected function getInput()
	{
		// Load the modal behavior script.
		JHtml::_( 'behavior.modal', 'a.modal' );

		// Build the script.
		$script = array();
		$script[] = '	function jSelectArticle_' . $this->id . '(id, title, catid, object) {';
		$script[] = '		document.id("' . $this->id . '_id").value = id;';
		$script[] = '		document.id("' . $this->id . '_name").value = title;';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration( implode( "\n", $script ) );

		// Setup variables for display.
		$html = array();
		$link = 'index.php?option=com_landingmanagement&amp;view=sites&amp;layout=modal&amp;tmpl=component&amp;function=jSelectArticle_' . $this->id;

		$db = JFactory::getDBO();
		$db->setQuery( 'SELECT title FROM #__landingmanagement_sites  WHERE id=' . (int)$this->value );

		try {
			$title = $db->loadResult();
		} catch (RuntimeException $e) {
			JError::raiseWarning( 500, $e->getMessage() );
		}

		if ( empty( $title ) ) {
			$title = JText::_( 'JSELECT' );
		}
		$title = htmlspecialchars( $title, ENT_QUOTES, 'UTF-8' );

		// The current user display field.
		$html[] = '<span class="input-append">';
		$html[] = '<input type="text" class="input-medium" id="' . $this->id . '_name" value="' . $title . '" disabled="disabled" size="35" /><a class="modal btn" title="' . JText::_( 'COM_LANDINGMANAGEMENT_CHANGE_SITE' ) . '"  href="' . $link . '&amp;' . JSession::getFormToken() . '=1" rel="{handler: \'iframe\', size: {x: 800, y: 450}}"><i class="icon-file"></i> ' . JText::_( 'JSELECT' ) . '</a>';
		$html[] = '</span>';

		$value = (int)$this->value ?  $value = (int)$this->value  : '';
		// class='required' for client side validation
		$class = $this->required ? ' class="required modal-value"' : '';

		$html[] = '<input type="hidden" id="' . $this->id . '_id"' . $class . ' name="' . $this->name . '" value="' . $value . '" />';

		return implode( "\n", $html );
	}
}
