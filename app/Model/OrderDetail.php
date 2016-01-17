<?php
App::uses('AppModel', 'Model');

class OrderDetail extends AppModel {


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'Order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function saveOrderDetail($orderDetail){
		$now = new DateTime('now', new DateTimeZone('UTC'));
		$orderDetail['OrderDetail']['created'] = $now->format('c');
		$this->create();
		return $this->save($orderDetail);
	}

}