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
}
?>