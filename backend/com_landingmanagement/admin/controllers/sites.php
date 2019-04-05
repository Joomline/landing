<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Controller for list current element
 * @author Aleks.Denezh
 */
class LandingmanagementControllerSites extends JControllerAdmin
{

	/**
	 * Class constructor
	 * @param array $config
	 */
	function __construct( $config = array() )
	{
		parent::__construct( $config );
	}

	/**
	 * Method to get current model
	 * @param String $name (model name)
	 * @param String $prefix (model prefox)
	 * @param Array $config
	 * @return model for current element
	 */
	public function getModel( $name = 'Site', $prefix = 'LandingmanagementModel', $config = array( 'ignore_request' => true ) )
	{
		return parent::getModel( $name, $prefix, $config );
	}

	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 * @return    void
	 */
	public function saveOrderAjax()
	{
		$pks = $this->input->post->get( 'cid', array(), 'array' );
		$order = $this->input->post->get( 'order', array(), 'array' );

		// Sanitize the input
		JArrayHelper::toInteger( $pks );
		JArrayHelper::toInteger( $order );

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder( $pks, $order );

		if ( $return ) {
			echo '1';
		}

		// Close the application
		JFactory::getApplication()->close();
	}

	public function setDefault(){
		$app = JFactory::getApplication();
		$cid =  $this->input->post->get( 'cid', array(), 'array' );
		if(!count($cid) || empty($cid[0])){
			$app->enqueueMessage('Empty site ID', 'error');
			$app->redirect(JRoute::_('index.php?option=com_landingmanagement&view=sites', false));
			return;
		}
		$cid = (int)$cid[0];

		$app->setUserState('com_landingmanagement.default_site', $cid);
		$app->redirect(JRoute::_('index.php?option=com_landingmanagement&view=sites', false));
		return;
	}
}