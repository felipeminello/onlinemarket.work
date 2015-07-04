<?php
namespace Market\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;

class ListingsTable extends TableGateway {
	public static $tableName = 'listings';
	
	public function getTableName() {
		return self::$tableName;
	}
	
	public function getListingsByCategory($category) {
		return $this->select(array('category' => $category));
	}
	
	public function getListinigById($id) {
		return $this->select(array('listings_id' => $id))->current();
	}
	
	public function getMostRecentListing($id = 0) {
		$select = new Select();
		$select->from($this->getTableName())
			   ->order('listings_id DESC')
			   ->limit(1);
		
		return $this->selectWith($select)->current();
	}
	
	public function addPosting(array $data) {
		list($city, $country) = explode(',', $data['cityCode']);
		
		$data['city'] = trim($city);
		$data['country'] = trim($country);
		
		$date = new \DateTime();
		
		if ($data['expires']) {
			if ($data['expires'] == 30) {
				$date->add('P1M');
			} else {
				$date->add(new \DateInterval('P'.$data['expires'].'D'));
			}
		}

        if (isset($data['photo_filename']) && is_array($data['photo_filename'])) {
            $data['photo_filename'] = $data['photo_filename']['name'];
        }
		
		$data['date_expires'] = $date->format('Y-m-d H:i:s');
		unset($data['cityCode'], $data['expires'], $data['captcha'], $data['enviar']);
		
		$this->insert($data);
		
	}
}