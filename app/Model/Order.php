<?php
App::uses('AppModel', 'Model');

class Order extends AppModel {


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id'
		)
	);
	/**
    *@param array $productId,$currencyAbbr the product id and  currency abbreviation
    *@return array order data
    **/

	public function getOrderDetails($productId,$currencyAbbr){
		$product = $this->Product->getProductById($productId);
		if(empty($product)){
			return false;
		}
		$currency = $this->Currency->getCurrencyByAbbreviation($currencyAbbr);
		if(empty($currency)){
			return false;
		}
		if($currency['Currency']['default'] == 1){
			$amount = (float) $product['Product']['price'];
		}else{
			$amount = (float) ($product['Product']['price'] * $currency['Currency']['rate']);
		}
		$order['Order']['title'] =  $product['Product']['title'];
		$order['Order']['product_id'] = $product['Product']['id'];
		$order['Order']['amount'] = $amount;
		$order['Order']['currency_id'] = $currency['Currency']['id'];
		return $order;
	}

	public function saveOrder($orderDetail){
		$currency =  $this->Currency->getCurrencyByAbbreviation($orderDetail['Order']['currency_abbr']);
		$orderDetail['Order']['currency_id'] = $currency['Currency']['id'];
		$now = new DateTime('now', new DateTimeZone('UTC'));
		$orderDetail['Order']['created'] = $now->format('c');
		$this->create();
		return $this->save($orderDetail);
	}


}