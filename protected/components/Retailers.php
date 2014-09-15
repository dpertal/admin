<?php
class Retailers{
	
	public static function getListRetailers(){
		$criteria = new CDbCriteria;
        $criteria->together = true;
		$criteria->limit = 8;
		$result = Retailer::model()->findAll($criteria);
		return $result;
	}
}
?>