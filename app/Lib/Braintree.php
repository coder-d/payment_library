<?
require_once '../Vendor/Braintree/lib/Braintree.php';

class Braintree{

	public function processPayment($postFormData){
		$clientToken = $this->_getClientToken();
		$customerId = $this->_createCustomer($postFormData);
		$paymentToken = $this->_createPaymentToken($postFormData,$customerId);
		$nonce = $this->_getPaymentMethodNonce($paymentToken);
		$sale = $this->_sale($postFormData,$nonce);
		if(!empty($sale->transaction->status)){
			$orderId = $this->_saveOrderData($postFormData);
				if(!empty($orderId)){
					return true;	
				}
		}
		return false;
		exit;
	}

	private function _getClientToken(){
		$environment = Configure::read('Braintree.environment');
		$merchantId = Configure::read('Braintree.MerchantId');
		$publicKey = Configure::read('Braintree.PublicKey');
		$privateKey = Configure::read('Braintree.PrivateKey');
		Braintree_Configuration::environment($environment);
		Braintree_Configuration::merchantId($merchantId);
		Braintree_Configuration::publicKey($publicKey);
		Braintree_Configuration::privateKey($privateKey); 
		//Get the Client Token
		$clientToken = Braintree_ClientToken::generate();
		return $clientToken;
	}

	private function _createCustomer($CustomerData){
		$name = explode(' ',$CustomerData['Order']['customer_name']);
		$firstName = $name[0];
		$lastName = $name[1];
		$customerDetails = Braintree_Customer::create(['firstName' => $firstName,'lastName' => $lastName]);
		return $customerDetails->customer->id;
	}

	private function _createPaymentToken($postFormData,$customerId){
		$ccNumber = $postFormData['Order']['cc_number'];
		$ccHolderName = $postFormData['Order']['cc_holder_name'];
		$expiration = str_split($postFormData['Order']['cc_expiration'], 2);
		$expirationMonth = $expiration[0];
		$expirationYear = $expiration[2];
		$cvv = $postFormData['Order']['cc_cvv'];
		$payment = Braintree_CreditCard::create(['number'=>$ccNumber, 'cardholderName' =>$ccHolderName ,
												'expirationMonth' =>$expirationMonth,'expirationYear' =>$expirationYear,'cvv' =>$cvv,
												'customerId'=>$customerId]);
		return $payment->creditCard->token;
	}

	private function _getPaymentMethodNonce($paymentToken){
		$nonce = Braintree_PaymentMethodNonce::create($paymentToken);
		return $nonce->paymentMethodNonce->nonce;
	}

	private function _sale($postFormData,$nonce){
		$amount = $postFormData['Order']['amount'];
		$currencyModelObj = ClassRegistry::init('Currency');
		$currency = $currencyModelObj->getCurrencyByAbbreviation($postFormData['Order']['currency_abbr']);
		$convertedAmount = (float) (round($amount/$currency['Currency']['rate'],2));
		$sale = Braintree_Transaction::sale(['amount'=>$convertedAmount,'paymentMethodNonce'=>$nonce]);
		return $sale;
	}

	private function _saveOrderData($postFormData){
		$orderModelObj = ClassRegistry::init('Order');
		$orderModelObj->saveOrder($postFormData);
		return $orderModelObj->id;
	}

	private function _saveBraintreeData($braintreeData,$orderId){
		$data['OrderDetail']['order_id'] = $orderId;
		$data['OrderDetail']['payment_id'] = $braintreeData->transaction->id;
		$data['OrderDetail']['payment_state'] = $braintreeData->transaction->status;
		$data['OrderDetail']['amount'] = $braintreeData->transaction->amount;
		$data['OrderDetail']['currency_abbreviation'] = $braintreeData->transaction->currencyIsoCode;
		$data['OrderDetail']['payment_gateway'] = 'Braintree';
		$orderDetailModelObj = ClassRegistry::init('OrderDetail');
		//debug($data);exit;
		return $orderDetailModelObj->saveOrderDetail($data);
	}

}