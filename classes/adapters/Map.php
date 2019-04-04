<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace adapters;

class Map extends Main
{
	protected $center, $zoom, $points, $cities;

	function __construct( \Config $config, $template ) {
		parent::__construct( $config, $template );
		$this->type = 'map';
	}

	public function show($block, $i, $view, &$params)
	{
		$this->type = $block['type'];
		$this->id = $block['alias'];
		$this->title = $block['name'];
		$this->input = json_decode($block['input'], true);

		$center_lat = isset($this->input['center_lat']) ? (float)$this->input['center_lat'] : 0;
		$center_lng = isset($this->input['center_lng']) ? (float)$this->input['center_lng'] : 0;
		$this->center = $center_lat.', '.$center_lng;
		$this->zoom = isset($this->input['zoom']) ? (int)$this->input['zoom'] : 4;
		$this->points= isset($this->input['points']) && is_array($this->input['points']) ? $this->input['points'] : array();

		$cities = isset($this->input['cities']) ? $this->input['cities'] : '';
		$this->cities = array();

		if(!empty($cities)){
			$cities = explode("\n", $cities);
			$cities = array_map('trim', $cities);
			if(is_array($cities) && count($cities)){
				foreach ( $cities as $city ) {
					$city = explode('::', $city);
					if(count($city) != 3){
						continue;
					}
					$this->cities[] = array(
						'city' => $city[0],
						'lat' => $city[1],
						'lng' => $city[2]
					);
				}
			}
		}
		$this->loadTpl();
	}
}