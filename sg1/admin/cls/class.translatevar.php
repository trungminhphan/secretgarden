<?php
class TranslateVar{
	const COLLECTION = 'translate_var';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $var = ''; 
	public $translate = '';//array('EN' => 'val', 'VI' => 'val')
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(TranslateVar::COLLECTION);
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
			'var' => $this->var,
			'translate' => $this->translate,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array('var' => $this->var, 'translate' => $this->translate));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);	
	}

	public function check_exists($var){
		$query = array('var' => $var);
		$field = array('_id' => true);
		$result = $this->_collection->findOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		else return false;
	}

	public function get_var($var, $lang){
		$query = array('var' => $var);
		$result = $this->_collection->findOne($query);
		if(isset($result['translate'][$lang])) return $result['translate'][$lang];
		else return $var;
	}
}
?>