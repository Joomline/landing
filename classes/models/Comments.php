<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace models;

class Comments extends Main {
	function getSelectorOptions($site_id, $order, $dirn, $limit){

		$result = $this->db->getAll("SELECT * FROM `#__landingmanagement_comments` WHERE site_id=?i ORDER BY ?p ?p LIMIT ?i",
			(int)$site_id, $order, $dirn, $limit
		);

		if(!is_array($result) || !count($result)){
			$result = array();
		}
		return $result;
	}


}