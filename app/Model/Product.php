<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {


	public function getProductById($id){
		return $this->find('first',array('conditions'=>array('Product.id'=>$id)));
	}


}