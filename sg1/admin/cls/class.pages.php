<?php
class Pages {
	const COLLECTION = 'pages';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $tieude = '';
	public $noidung = '';
	public $hinhanh = '';
	public $hienthi = 0;
	public $orders = 0;
	public $language = '';
	public $path = '';
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Pages::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_all_list_lang($language){
		$query = array('language' => $language);
		return $this->_collection->find($query)->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_root_list(){
		$query = array('id_parent' => '');
		return $this->_collection->find($query);
	}

	public function get_root_list_lang($language){
		$query = array('id_parent' => '', 'language' => $language);
		return $this->_collection->find($query);	
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_list_to_parent(){
		$query = array('id_danhmucPages' => $this->id_danhmucPages);
		return $this->_collection->find($query)->limit(20)->sort(array('orders' => 1, 'date_post'=>-1));	
	}
	public function get_list_to_parent_lang($language){
		$query = array('id_danhmucPages' => $this->id_danhmucPages, 'language' => $language);
		return $this->_collection->find($query)->limit(20)->sort(array('orders' => 1, 'date_post'=>-1));	
	}

	public function get_Pagesmoi(){
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1))->limit(3);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_one_lang($language){
		$query = array('_id' => new MongoId($this->id), 'language' => $language);
		return $this->_collection->findOne($query);
	}

	public function get_list_home($dmtt){
		$query = array('id_danhmucPages' => $dmtt, 'hienthi' => 1);
		return $this->_collection->find($query)->limit(3);
	}

	public function get_list_home_lang($dmtt, $language){
		$query = array('id_danhmucPages' => $dmtt, 'hienthi' => 1, 'language' => $language);
		return $this->_collection->find($query)->limit(3);
	}

	public function insert(){
		$query = array(
			'_id' => new MongoId($this->id),
			'tieude' => $this->tieude,
			'noidung' => $this->noidung,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
			'language' => $this->language,
			'path' => $this->path,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array(
			'tieude' => $this->tieude,
			'noidung' => $this->noidung,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
			'language' => $this->language,
			'date_post' => new MongoDate()
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}
}

?>