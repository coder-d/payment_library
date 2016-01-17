<?php
App::uses('AppController', 'Controller');
App::uses('PaymentGatewayProcessor', 'Lib');

class OrdersController extends AppController {

/* 
The index function fetches the following data:
All the product(for testing pupose there is only one product)
List of currencies
List of credit cards(from the bootstrap file)
*/
	public function index(){
		$this->set('products',$this->Order->Product->find('all'));
		$this->set('currencies',$this->Order->Currency->find('all'));
		$this->set('creditCards',Configure::read('SupportedCreditCards'));
	}
/*
The checkout function receives the product_id,currency and customer name in post method
and fetches the product details.

*/
	public function checkout(){
		if($this->request->is('post')){
			$orderDetail = $this->Order->getOrderDetails($this->request->data['Order']['product_id'],$this->request->data['Product']['currency']);
			if(empty($orderDetail)){

			}
			$orderDetail['Order']['customer_name'] = $this->request->data['Order']['customer_name'];
			$this->set('orderDetail',$orderDetail);
			$this->set('currency',$this->request->data['Product']['currency']);
			$this->set('creditCards',Configure::read('SupportedCreditCards'));
		}
	}
/*
The process_payment function receives all the order details in post method.
Selects the payment gateway using the _paymentGatewaySelector function
If a valid gateway is found the PaymentGatewayProcessor library class is used to create an instanse
of the appropriate payment gateway class and the payment is processed. 
*/
	public function process_payment(){
		if(!$this->request->is('post')){
			return false;
		}
		$paymentGateway = $this->_paymentGatewaySelector($this->request->data);
		if(!$paymentGateway){
			$process = 'fail';
		}
		if(PaymentGatewayProcessor::load($paymentGateway)->processPayment($this->request->data)){
			$process = 'success';
		}else{
			$process = 'fail';		
		}
		$this->set('process',$process);
		$this->redirect(array('action' => 'payment_status', 'process' => $process));
	}

	public function payment_status(){
		$this->set('process',$this->passedArgs['process']);
	}
/*
Logic to select the payment gateway

*/
	private function _paymentGatewaySelector($postFormData){
		$processPayment = true;
		switch($postFormData['Order']['cc_type']){
				case 'AMEX':    
								if($postFormData['Order']['currency_abbr'] != 'USD'){
									$processPayment = false;
								}else{
									$paymentGateway = 'Paypal';
								}
								break; 
				case 'MASTER CARD' :
				case 'VISA' :		
								if($postFormData['Order']['currency_abbr'] == 'USD' || 
								   $postFormData['Order']['currency_abbr'] == 'EUR' ||
								   $postFormData['Order']['currency_abbr'] == 'AUD'){
									$paymentGateway = 'Paypal';
								}else{
									$paymentGateway = 'Braintree';
								}
								break;
		}
		if($processPayment){
			return $paymentGateway;
		}else{
			return false;
		}
	}
	
	public function processPaypalPaymentReturn(){
		$this->layout = 'ajax';  // uses an empty layout
		$this->autoRender=false;
		
	}

	public function processPaypalPaymentCancel(){
		$this->layout = 'ajax';  // uses an empty layout
		$this->autoRender=false;
	}



}