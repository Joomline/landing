<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Object Class Table
 * @author Joomline
 */
class TableLandingmanagement_Sites extends JTable
{

	/**
	 * Class constructor
	 * @param Object $db (database link object)
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__landingmanagement_sites', 'id', $db );
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

		$array['alias'] = JApplication::stringURLSafe( $array['alias'] );
		if ( trim( str_replace( '-', '', $array['alias'] ) ) == '' ) {
			$array['alias'] = JApplication::stringURLSafe( $array['title'] );
		}

		if ( isset( $array['text'] ) )
		{
			$pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
			$tagPos = preg_match($pattern, $array['text'] );

			if ($tagPos == 0)
			{
				$this->introtext = $array['text'];
				$this->fulltext = '';
			}
			else
			{
				list ($this->introtext, $this->fulltext) = preg_split( $pattern, $array['text'], 2 );
			}
		}

		if ( isset( $array['abstract'] ) && is_array( $array['abstract'] ) )
		{
			$registry = new JRegistry;
			$registry->loadArray( $array['abstract'] );
			$array['abstract'] = (string) $registry;
		}

		return parent::bind( $array, $ignore );
	}

}