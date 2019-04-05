<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component landingmanagement
 * @author Joomline
 */
require_once JPATH_COMPONENT.'/helpers/landingmanagement.php';

$lang = JFactory::getLanguage();
$lang->load('com_landingmanagement', JPATH_ROOT . '/administrator/components/com_landingmanagement');

$controller = JControllerLegacy::getInstance( 'landingmanagement' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();