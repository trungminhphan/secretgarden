<?php
class Hub {
	const COLLECTION = 'hub';
	private $_mongo;
	private $_collection;

	public $id = '5996dfce7247aeb00f00002c';
	public $logo = array();
	public $banner = array(); //array('orders' 'name', 'address', link, hinhanh);
	public $icon = array();
	public $background = array();

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Hub::COLLECTION);
	}

	public function edit(){
		$query = array('$set' => array(
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
			'banner' => $this->banner,
			'icon' => $this->icon,
			'background' => $this->background
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}
}
?>