<?php
App::uses('AppModel', 'Model');

class OrderFail extends AppModel {


public function saveOrderFail($orderDetail,$error,$paymentGateway){
	$orderFail['OrderFail']['order_details'] = json_encode($orderDetail);
	$orderFail['OrderFail']['error'] = $error;
	$orderFail['OrderFail']['payment_gateway'] = $paymentGateway;
	$now = new DateTime('now', new DateTimeZone('UTC'));
	$orderFail['OrderFail']['created'] = $now->format('c');
	$this->create();
	return $this->save($orderFail);
}


}
