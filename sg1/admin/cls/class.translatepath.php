<?php
class TranslatePath{
	const COLLECTION = 'translate_path';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $path = ''; //array('EN' => 'path', 'VI' => path)
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(TranslatePath::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('date_post'=>-1));
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('date_post'=>-1));
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}

	public function insert(){
		$query = array(
			'path' => $this->path,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array('path' => $this->path));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);	
	}
	
	public function check_path($query){
		$field = array('_id' => true);
		$result = $this->_collection->findOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		return false;
	}

	public function get_path($path, $lang1, $lang2){
		$query = array('path.'.$lang1 => $path);
		$result = $this->_collection->findOne($query);
		if(isset($result['path'][$lang2]) && $result['path'][$lang2]) return $result['path'][$lang2];
		else return $path;
	}
}

?>