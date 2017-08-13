<?php
 class Languages {
 	const COLLECTION = 'languages';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $code = '';
	public $name = '';
	public $icon = '';
	public $default = '';
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Languages::COLLECTION);
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
			'code' => $this->code,
			'name' => $this->name,
			'icon' => $this->icon,
			'default' => intval($this->default),
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}
	public function edit(){
		$query = array('$set' => array(
			'code' => $this->code,
			'name' => $this->name,
			'icon' => $this->icon,
			'default' => intval($this->default)
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function set_non_defalt(){
		$query = array('$set' => array('default' => 0));
		$condition = array('default' => 1);
		return $this->_collection->update($condition, $query);
	}
	public function set_default(){
		$this->set_non_defalt();
		$query = array('$set' => array('default' => 1));
		$condition = array('_id' => new MongoID($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function check_exists_by_code(){
		$query = array('code' => new MongoRegex($this->code . '/i'));
		$filed = array('_id' => true);
		$result = $this->_collection->findOne($query);
		if(isset($result['_id']) && $result['_id']) return true;
		return false;
	}
 }