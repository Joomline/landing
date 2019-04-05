<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Object Class Table
 * @author Joomline
 */
class TableLandingmanagement_Comments extends JTable
{

	/**
	 * Class constructor
	 * @param Object $db (database link object)
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__landingmanagement_comments', 'id', $db );
	}

	/**
	 * Method for loading data into the object field
	 * @param Array $array (Featured in the field of data)
	 * @param String $ignore
	 * @return Boolean result
	 */
	public function bind( $array, $ignore = '' )
	{
		if ( empty( $array['created_by'] ) ) {
			$user = JFactory::getUser();
			$array['created_by'] = $user->id;
		}
		if ( empty( $array['created'] ) ) {
			$array['created'] = date( 'Y-m-d H:i:s' );
		}

		return parent::bind( $array, $ignore );
	}

}