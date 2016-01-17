<?php
App::uses('Object', 'Model');

class PaymentGatewayProcessor {

	private static $_instance = null;
	private $_paymentGatewayInstance = null;


/*
*Constructor
*/	
	private function __construct($paymentGateway) {		
		$this->_paymentGatewayInstance = $this->getPaymentGatewayInstance($paymentGateway);
	}

	/*
* Load payment gateway library
*/
	public static function load($paymentGateway) {
		self::$_instance = null;
		self::$_instance = new self($paymentGateway);	
		//debug(self::$_instance);exit;	
		return self::getInstance();
	}

	public function processPayment($postFormData) {
		$orderFailModelObj = ClassRegistry::init('OrderFail');
		try{
			$result = $this->_paymentGatewayInstance->processPayment($postFormData);
			if(!$result){
				throw new Exception('Could not process payment');
			}
				
		}
		catch(Exception $ex) {
			$paymentGatewayName = get_class ($this->_paymentGatewayInstance);
			$orderFailModelObj = ClassRegistry::init('OrderFail');
			$orderFailModelObj->saveOrderFail($postFormData,$ex->getMessage(),$paymentGatewayName);
		}
	return $result;	
	}

/*
* getInstance
*/	
	public static function getInstance() {
		return self::$_instance;
	}

/*
*getPaymentGatewayInstance
*/
	private function getPaymentGatewayInstance($paymentGateway) {
		App::uses($paymentGateway, 'Lib');
		return new $paymentGateway();
	}




}

?>