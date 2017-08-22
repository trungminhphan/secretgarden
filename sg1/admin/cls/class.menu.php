<?php
class Menu {
    const COLLECTION = 'menu';
    private $_mongo;
    private $_collection;

    public $id = '';
    public $ten = '';
    public $link = '';
    public $id_parent = '';
    public $mota = '';
    public $language = '';
    public $orders = 0;
    public $date_post ='';

    public function __construct(){
        $this->_mongo = DBConnect::init();
        $this->_collection = $this->_mongo->getCollection(Menu::COLLECTION);
    }

    public function get_all_list(){
        return $this->_collection->find()->sort(array('date_post'=>1));
    }

    public function get_all_list_lang($language){
        $query = array('language' => $language);
        return $this->_collection->find($query)->sort(array('orders'=>1));
    }

    public function get_list_condition($condition){
        return $this->_collection->find($condition)->sort(array('date_post'=>1));
    }

    public function get_one(){
        $query = array('_id' => new MongoId($this->id));
        return $this->_collection->findOne($query);
    }

    public function get_one_lang($language){
        $query = array('_id' => new MongoId($this->id), 'language' => $language);
        return $this->_collection->findOne($query);
    }

    public function get_id_by_date_post(){
        $query = array('date_post' => trim($this->date_post));
        $field = array('_id' => true);
        $result = $this->_collection->findOne($query, $field);
        if(isset($result['_id'])) return $result['_id'];
        else return false;
    }

    public function insert(){
        $query = array(
            'ten' => $this->ten,
            'link' => $this->link,
            'id_parent' => $this->id_parent ? new MongoId($this->id_parent) : '',
            'mota' => $this->mota,
            'language' => $this->language,
            'orders' => intval($this->orders),
            'date_post' => new MongoDate()
        );
        return $this->_collection->insert($query);
    }

    public function edit(){
        $query = array('$set' => array(
            'ten' => $this->ten,
            'link' => $this->link,
            'id_parent' => $this->id_parent ? new MongoId($this->id_parent) : '',
            'mota' => $this->mota,
            'language' => $this->language,
            'orders' => intval($this->orders)));
        $condition = array('_id' => new MongoId($this->id));
        return $this->_collection->update($condition, $query);
    }

    public function delete(){
        $query = array('_id' => new MongoId($this->id));
        return $this->_collection->remove($query);
    }

    public function check_dmmenu($id_menu){
        $query = array('id_parent' => new MongoId($id_menu));
        $field = array('_id' => true);
        $result = $this->_collection->findOne($query, $field);
        if(isset($result['_id']) && $result['_id']) return true;
        else return false;
    }

}
?>