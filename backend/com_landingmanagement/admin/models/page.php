<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Модель редактирования текущего элемента
 * @author Joomline
 */
class LandingmanagementModelPage extends JModelAdmin {

	/**
	 * загрузка текущей формы
	 * @param Array $data
	 * @param Boolean $loadData
	 * @return Object form data
	 */
	public function getForm( $data = array( ), $loadData = true ) {
		$form = $this->loadForm( 'com_landingmanagement.page', 'page', array( 'control' => 'jform', 'load_data' => $loadData ) );
		if ( empty( $form ) ) {
			return false;
		}
		$user = JFactory::getUser();
		if ( !$user->authorise( 'core.edit.state', '#__landingmanagement_pages.' . $this->getState( 'extdataedit.id' ) ) ) {
			$form->setFieldAttribute( 'published', 'disabled', 'true' );
			$form->setFieldAttribute( 'published', 'filter', 'unset' );
		}
		return $form;
	}

	/**
	 * @param Int $id (object identifier)
	 * @return Object (current item)
	 */
	public function getItem( $id = null ) {
		if ( $item = parent::getItem( $id ) ) {
			$item->text = trim( $item->fulltext ) != '' ? $item->introtext . '<hr id="system-readmore" />' . $item->fulltext : $item->introtext;
		}
		return $item;
	}

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable|mixed
	 */
	public function getTable( $type = 'landingmanagement_pages', $prefix = 'Table', $config = array( ) ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * Загрузка данных в форму
	 * @return Object
	 */
	protected function loadFormData() {
		$data = JFactory::getApplication()->getUserState( 'com_landingmanagement.edit.page.data', array() );
		if ( empty( $data ) ) {
			$data = $this->getItem();
		}
		return $data;
	}

	/**
	 * Запрет удаления записи
	 * @param object $record
	 * @return bool
	 */
	protected function canDelete( $record )
	{
		if ( !empty( $record->id ) ) {
			return JFactory::getUser()->authorise( 'core.delete', '#__landingmanagement_pages.' . (int)$record->id );
		}
	}

	/**
	 * Запрет изменения состояния
	 * @param object $record
	 * @return bool
	 */
	protected function canEditState( $record )
	{
		$user = JFactory::getUser();

		// Check for existing article.
		if ( !empty( $record->id ) ) {
			return $user->authorise( 'core.edit.state', '#__landingmanagement_pages.' . (int)$record->id );
		} // New article, so check against the category.
		elseif ( !empty( $record->catid ) ) {
			return $user->authorise( 'core.edit.state', '#__landingmanagement_pages.' . (int)$record->catid );
		} // Default to component settings if neither article nor category known.
		else {
			return parent::canEditState( 'com_landingmanagement' );
		}
	}

}