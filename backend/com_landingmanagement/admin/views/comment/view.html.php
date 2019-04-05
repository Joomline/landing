<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * View for edit current element
 * @author Joomline
 */
class LandingmanagementViewComment extends JViewLegacy
{

	/**
	 * @var $form JForm
	 */
	public $form;
	/**
	 * @var $item stdClass
	 */
	public $item;
	/**
	 * @var $user JUser
	 */
	public $user;
	/**
	 * @var $tags stdClass[]
	 */
	public $state;
	/**
	 * @var $user JUser
	 */

	/**
	 * Method to display the current pattern
	 * @param String $tpl
	 */
	public function display( $tpl = null )
	{
		$this->form = $this->get( 'Form' );
		$this->item = $this->get( 'Item' );
		$this->user = JFactory::getUser();
		$this->state = $this->get( 'State' );
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			JError::raiseError( 500, implode( '\n', $errors ) );
			return false;
		}
		$this->loadHelper( 'landingmanagement' );
		$this->canDo = landingmanagementHelper::getActions( 'comment' );
		$this->_setToolBar();
		parent::display( $tpl );
	}

	/**
	 * Method to display the toolbar
	 */
	protected function _setToolBar()
	{
		JFactory::getApplication()->input->set( 'hidemainmenu', true );
		$isNew = ( $this->item->id == 0 );
		$canDo = landingmanagementHelper::getActions( 'comment', $this->item->id );
		JToolBarHelper::title( JText::_( 'COM_LANDINGMANAGEMENT' ) . ': <small>[ ' . ( $isNew ? JText::_( 'JTOOLBAR_NEW' ) : JText::_( 'JTOOLBAR_EDIT' ) ) . ']</small>' );
		// For new records, check the create permission.
		if ( $isNew && ( count( $this->user->getAuthorisedCategories( 'com_landingmanagement', 'core.create' ) ) > 0 ) ) {
			JToolBarHelper::apply( 'comment.apply' );
			JToolBarHelper::save( 'comment.save' );
			JToolBarHelper::save2new( 'comment.save2new' );
			JToolBarHelper::cancel( 'comment.cancel' );
		} else {
			// Can't save the record if it's checked out.
			// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
			if ( $canDo->get( 'core.edit' ) || ( $canDo->get( 'core.edit.own' ) && $this->item->created_by == $this->user->get( 'id' ) ) ) {
				JToolBarHelper::apply( 'comment.apply' );
				JToolBarHelper::save( 'comment.save' );

				// We can save this record, but check the create permission to see if we can return to make a new one.
				if ( $canDo->get( 'core.create' ) ) {
					JToolBarHelper::save2new( 'comment.save2new' );
				}
			}

			// If checked out, we can still save
			if ( $canDo->get( 'core.create' ) ) {
				JToolBarHelper::save2copy( 'comment.save2copy' );
			}

			JToolBarHelper::cancel( 'comment.cancel', 'JTOOLBAR_CLOSE' );
		}
	}
}