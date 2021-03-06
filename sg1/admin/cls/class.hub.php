<?php
class Hub {
	const COLLECTION = 'hub';
	private $_mongo;
	private $_collection;

	public $id = '599a7f96a401839023000032';
	public $logo =  array();
	public $banner = array(); //array('orders' 'name', 'address', link, hinhanh);

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Hub::COLLECTION);
	}

	public function edit(){
		$query = array('$set' => array(
			'logo' => $this->logo,
			'banner' => $this->banner
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function edit_banner(){
		$query = array('$set' => array(
			'logo' => $this->logo,
			'banner' => $this->banner
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}
}
?>