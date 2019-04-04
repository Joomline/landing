<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace models;

class Catalog extends Main {
	function getSelectorOptions($fileId){

		$result = $this->db->getAll("SELECT `carbrand`, `model`, `modifications`, `engine`, `year`, `oem`, `crosses` 
			FROM `#__brandparts_data` WHERE file_id=?i", (int)$fileId);

		if(!is_array($result) || !count($result)){
			return false;
		}
		$data = array();
		foreach ( $result as $item ) {
			if(!isset($data[$item['carbrand']])){
				$data[$item['carbrand']] = array();
			}
			if(!isset($data[$item['carbrand']][$item['model']])){
				$data[$item['carbrand']][$item['model']] = array();
			}
			if(!isset($data[$item['carbrand']][$item['model']][$item['modifications']])){
				$data[$item['carbrand']][$item['model']][$item['modifications']] = array();
			}
			if(!isset($data[$item['carbrand']][$item['model']][$item['modifications']][$item['engine']])){
				$data[$item['carbrand']][$item['model']][$item['modifications']][$item['engine']] = array();
			}
			if(!isset($data[$item['carbrand']][$item['model']][$item['modifications']][$item['engine']][$item['year']])){
				$data[$item['carbrand']][$item['model']][$item['modifications']][$item['engine']][$item['year']] = '';
			}
		}
		return $data;
	}

	public function getResultItems()
	{
		$input = new \Input();
		$carbrand = $input->getString('carbrand', '');
		$model = $input->getString('model', '');
		$modification = $input->getString('modification', '');
		$engine = $input->getString('engine', '');
		$year = $input->getString('year', '');
		$fileId = $input->getInt('file_id', 0);

		if($fileId == 0){
			return array();
		}

		$brandId = (int)$this->db->getOne('SELECT `brand_id` FROM `#__brandparts_settings` WHERE id = ?i', (int)$fileId);

		if($brandId == 0){
			return array();
		}
		$query = 'SELECT oem, crosses FROM #__brandparts_data'
			.' WHERE file_id = "'.$fileId.'" AND carbrand = "'.$carbrand.'" AND model = "'.$model.'"'
			.' AND modifications = "'.$modification.'" AND engine = "'.$engine.'" AND year = "'.$year.'"'
		;

		$result = $this->db->getAll($query);

		if(!is_array($result) || !count($result)){
			return array();
		}
		$oems = $crosses = array();
		foreach ($result as $v){
			$v['crosses'] = json_decode($v['crosses'], true);
			if(!is_array($v['crosses'])){
				$v['crosses'] = array();
			}
			$crosses = array_merge($crosses, $v['crosses']);
			$oems[] = $v['oem'];
		}

		if(count($oems)){
			try{
				$itemList = $this->searchItemsByOem($brandId, $oems, $crosses);
			}
			catch (\Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			return array();
		}

		$detailIds = array();
		foreach ($itemList AS $item)
		{
			$item['oem']         = strtoupper($item['oem']);
			if(isset($item['detail_id'])) {
				$detailIds[$item['detail_id']] = $item['detail_id'];
			}
		}

		$ids    = implode(',', $detailIds);
		$images = $this->getImagesByDetailIds($ids);

		foreach ($itemList as $detail) {
			$detail['detail_image']                = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_url_thumb) ? $images[$detail['detail_id']]->file_url_thumb : '';
			$detail['detail_image_big']            = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_url) ? $images[$detail['detail_id']]->file_url : '';
			$detail['image_title']                 = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_title) ? $images[$detail['detail_id']]->file_title : '';
			$detail['image_description']           = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_description) ? $images[$detail['detail_id']]->file_description : '';
			$detail['image_alt']                   = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_meta) ? $images[$detail['detail_id']]->file_meta : '';
		}

		return $itemList;
	}


	public function getOemItems()
	{
		$input = new \Input();
		$oem = $input->getString('oem', '');
		$carbrand = $input->getString('carbrand', '');
		$model = $input->getString('model', '');
		$engine = $input->getString('engine', '');
		$year = $input->getString('year', '');
		$fileId = $input->getInt('file_id', 0);

		$request = compact('oem', 'carbrand', 'model', 'engine', 'year', 'fileId');

		if($fileId == 0 || $oem == ''){
			return array();
		}

		$brandId = (int)$this->db->getOne('SELECT `brand_id` FROM `#__brandparts_settings` WHERE id = ?i', (int)$fileId);

		if($brandId == 0){
			return array();
		}

		$where = array();
		$where[] = ('file_id = "'.$fileId.'"');
		$where[] = ('oem = "'.$oem.'"');

		$mode = 'oem';
		if(!empty($carbrand)){
			$where[] = ('carbrand = "'.$carbrand.'"');
			$mode = 'carbrand';
		}
		if(!empty($model)){
			$where[] = ('model = "'.$model.'"');
			$mode = 'model';
		}
		$query = 'SELECT oem, carbrand, model, modifications, engine, year, crosses FROM #__brandparts_data WHERE '.implode(' AND ', $where);

		$brandpartsData = $this->db->getAll($query);

		if(!is_array($brandpartsData) || !count($brandpartsData)){
			return array('itemList' => array(), 'brandpartsData' => array(), 'mode' => array(), 'request' => array());
		}

		$crosses = array();
		foreach ($brandpartsData as $v){
			$v->crosses = json_decode($v->crosses, true);
			if(!is_array($v->crosses)){
				$v->crosses = array();
			}
			$crosses = array_merge($crosses, $v->crosses);
		}

		$crosses = array_unique($crosses);

		$oems = array($oem);

		try{
			$itemList = $this->searchItemsByOem($brandId, $oems, $crosses);
		}
		catch (\Exception $e){
			echo $e->getMessage();
		}

		if(!is_array($itemList) || !count($itemList)){
			return array();
		}

		$detailIds = array();
		foreach ($itemList AS $item) {
			$item['oem']         = strtoupper($item['oem']);
			if(isset($item['detail_id'])) {
				$detailIds[$item['detail_id']] = $item['detail_id'];
			}
		}

		$ids    = implode(',', $detailIds);
		$images = $this->getImagesByDetailIds($ids);

		foreach ($itemList as $detail) {
			$detail['detail_image']                = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_url_thumb) ? $images[$detail['detail_id']]->file_url_thumb : '';
			$detail['detail_image_big']            = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_url) ? $images[$detail['detail_id']]->file_url : '';
			$detail['image_title']                 = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_title) ? $images[$detail['detail_id']]->file_title : '';
			$detail['image_description']           = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_description) ? $images[$detail['detail_id']]->file_description : '';
			$detail['image_alt']                   = isset($images[$detail['detail_id']]) && isset($images[$detail['detail_id']]->file_meta) ? $images[$detail['detail_id']]->file_meta : '';
		}

		return compact('itemList', 'brandpartsData', 'mode', 'request');
	}

	function searchItemsByOem($brandId, $oem, $crosses)
	{
		if (!count($oem)) return false;

		$p   = '/[-.\/\(\)\s\\\\]+/i';
		foreach ($oem as $k => $v){
			$oem[$k] = trim($oem[$k]);
			$oem[$k] = preg_replace($p, '', $oem[$k]);
			$oem[$k] = strtoupper($oem[$k]);
		}
		$oem = "'".implode("', '", $oem)."'";

		$this->db->query('DROP TABLE IF EXISTS tmpBrandParts');


		$q = 'CREATE TEMPORARY TABLE tmpBrandParts AS
              SELECT d1.* FROM #__auto_detail AS d1 WHERE d1.oem IN (' . $oem . ') AND d1.brand_id = "'.$brandId.'"';
		$this->db->query($q);

		$q ='ALTER TABLE tmpBrandParts ADD UNIQUE idx_tmpBrandParts (detail_id)';
		$this->db->query($q);

		if(is_array($crosses) && count($crosses)){
			$where = array();
			foreach ( $crosses as $cross ) {
				$where[] = '(d1.oem = "' . $cross["o"] . '" AND d1.brand_id = "'.$cross["b"].'")';
			}
			$where = implode(' OR ', $where);

			$sql = 'INSERT IGNORE INTO tmpBrandParts SELECT d1.* FROM #__auto_detail AS d1 WHERE ' . $where;
			$this->db->query($sql);
		}

		$query = 'SELECT DISTINCT
            d.*,
            b.name AS brand, b.is_original AS is_original, b.image_name brand_image,
            di.name, di.price, di.delivery_date AS delivery_date,
            di.amount, di.pricelist_id, di.set_amount, di.pricelist_supply_code,
            di.min_price, CASE WHEN di.pricelist_id IS NULL THEN 1 ELSE 0 END AS filter,
            di.old_price AS old_price,
            di.detailinfo_id AS detailinfo_id,
            (SELECT file_url FROM #__auto_mart_medias AS mm INNER JOIN #__auto_mart_detail_medias AS mdm ON mm.automart_media_id = mdm.automart_media_id WHERE mdm.detail_id = d.detail_id LIMIT 1)AS image,
            (SELECT full_description FROM #__auto_brand_metainfo AS bmi WHERE bmi.brand_id = d.brand_id) AS brand_desc,
            (SELECT short_description FROM #__auto_detail_metainfo AS dmi WHERE dmi.detail_id = d.detail_id) AS short_description
        	FROM tmpBrandParts AS d
        	INNER JOIN #__auto_detail_info AS di ON di.detail_id = d.detail_id
        	INNER JOIN #__auto_brand AS b ON b.brand_id = d.brand_id
         	LIMIT 1000';

		$result = $this->db->getAll($query);
		return $result;
	}

	public function getImagesByDetailIds($detailIds)
	{
		if (!$detailIds) {
			return false;
		}
		$query = 'SELECT mm.*, dm.detail_id FROM #__auto_mart_medias AS mm'
			.' INNER JOIN #__auto_mart_detail_medias AS dm ON dm.automart_media_id = mm.automart_media_id'
			.' WHERE mm.published = 1 AND mm.file_is_main_image = 1 AND mm.file_mimetype LIKE "image%"'
			.' AND dm.detail_id IN (' . $detailIds . ')'
		;

		$result = $this->db->getInd('detail_id', $query);
		return $result;
	}
}