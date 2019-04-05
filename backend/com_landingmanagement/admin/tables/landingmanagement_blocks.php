<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Object Class Table
 * @author Joomline
 */
class TableLandingmanagement_Blocks extends JTable
{

	/**
	 * Class constructor
	 * @param Object $db (database link object)
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__landingmanagement_blocks', 'id', $db );
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
		if ( isset( $array['rules'] ) && is_array( $array['rules'] ) ) {
			$rules = new JAccessRules( $array['rules'] );
			$this->setRules( $rules );
		}
		$array['alias'] = JApplication::stringURLSafe( $array['alias'] );
		if ( trim( str_replace( '-', '', $array['alias'] ) ) == '' ) {
			$array['alias'] = JApplication::stringURLSafe( $array['title'] );
		}



		if ( isset( $array['input'] ) && is_array( $array['input'] ) )
		{
			$registry = new JRegistry;
			$registry->loadArray( $array['input'] );
			$array['input'] = (string) $registry;
		}

		return parent::bind( $array, $ignore );
	}

}