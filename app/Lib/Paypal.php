<?

class Paypal {


	public function processPayment($postFormData){
		$accessToken = $this->_getAccessToken();
		if(empty($accessToken['access_token'])){
			return false;
		}else{
			$paymentResponse = $this->_makePayment($postFormData,$accessToken['access_token']);
			if(!empty($paymentResponse['id'])){
				$orderId = $this->_saveOrderData($postFormData);
				if(!empty($orderId)){
					$this->_savePaypalData($paymentResponse,$orderId);
					return true;
				}	
			}
		}
		return false;
	}

/*
* get access token from paypal
*/
	private function _getAccessToken(){
		$client = Configure::read('PayPal.Sandbox.Client ID');
		$secret = Configure::read('PayPal.Sandbox.Secret');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
		curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept: application/json','Accept-Language: en_US'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		$jsonResponse = curl_exec($ch);
		$responseData = json_decode($jsonResponse,true);
		//debug($responseData);
		return $responseData;
	}

/*
* send order data and accesstoken to paypal for payment
*/

	private function _makePayment($postFormData,$accessToken){
		$data = $this->_paymentDataFormat($postFormData);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
		$jsonResponse = curl_exec($ch);
		$responseData = json_decode($jsonResponse,true);
		//debug($jsonResponse);
		return $responseData;
	}

	private function _paymentDataFormat($postFormData){
		$paymentData['ccNumber'] = $postFormData['Order']['cc_number'];
		$paymentData['ccType'] = str_replace(' ','',strtolower($postFormData['Order']['cc_type']));
		$ccExpireSplit=  str_split($postFormData['Order']['cc_expiration'], 2);
		$paymentData['ccExpireMonth'] = $ccExpireSplit[0];
		$paymentData['ccExpireYear'] = $ccExpireSplit[1].$ccExpireSplit[2];
		$paymentData['ccCvv']= $postFormData['Order']['cc_cvv'];
		$ccNameSplit = explode(" ",$postFormData['Order']['cc_holder_name']);
		$paymentData['ccFirstName'] = $ccNameSplit[0];
		$paymentData['ccLastName'] = $ccNameSplit[1];
		$paymentData['amount'] = $postFormData['Order']['amount'];
		$paymentData['currency'] = $postFormData['Order']['currency_abbr'];
		$paymentData['paymentDescription'] = 'Payment for '.$postFormData['Order']['title'];
		$data = '{
		  "intent":"sale",
		  "redirect_urls":{
		    "return_url":"'.Configure::read('Paypal.Return URL').'",
		    "cancel_url":"'.Configure::read('Paypal.Cancel URL').'"
		  },
		  "payer": {
		    "payment_method": "credit_card",
		    "funding_instruments": [
		      {
		        "credit_card": {
		          "number": "'.$paymentData['ccNumber'].'",
		          "type": "'.$paymentData['ccType'].'",
		          "expire_month": '.$paymentData['ccExpireMonth'].',
		          "expire_year": '.$paymentData['ccExpireYear'].',
		          "cvv2": '.$paymentData['ccCvv'].',
		          "first_name": "'.$paymentData['ccFirstName'].'",
		          "last_name": "'.$paymentData['ccLastName'].'"
		        }
		      }
		    ]
		  },
		  "transactions":[
		    {
		      "amount":{
		        "total":"'.$paymentData['amount'].'",
		        "currency":"'.$paymentData['currency'].'"
		      },
		      "description":"'.$paymentData['paymentDescription'].'"
		    }
		  ]
		}
		';
		return $data;
	}

	private function _saveOrderData($postFormData){
		$orderModelObj = ClassRegistry::init('Order');
		$orderModelObj->saveOrder($postFormData);
		return $orderModelObj->id;
	}

	private function _savePaypalData($paypalData,$orderId){
		$data['OrderDetail']['order_id'] = $orderId;
		$data['OrderDetail']['payment_id'] = $paypalData['id'];
		$data['OrderDetail']['payment_state'] = $paypalData['state'];
		$data['OrderDetail']['amount'] = $paypalData['transactions'][0]['amount']['total'];
		$data['OrderDetail']['currency_abbreviation'] = $paypalData['transactions'][0]['amount']['currency'];
		$data['OrderDetail']['payment_gateway'] = 'Paypal';
		$orderDetailModelObj = ClassRegistry::init('OrderDetail');
		return $orderDetailModelObj->saveOrderDetail($data);
	}



}?>