<?php
App::uses('Order', 'Model');

/**
 * Order Test Case
 *
 */
class OrderTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product','app.order','app.currency');

	/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Order = ClassRegistry::init('Order');
	}


	public function testGetOrderDetails(){
		$result = $this->Order->getOrderDetails('1','USD'); 
		$expected = array('title' => 'iphone 5','amount' => '649','product_id'=>'1','currency_id'=>'1');       
        $this->assertContains($expected, $result);
	}



}