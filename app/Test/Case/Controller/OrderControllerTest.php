<?php
App::uses('OrdersController', 'Controller');

/**
 * TestOrdersController *
 */
class TestOrdersController extends OrdersController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}

}


	/**
 * OrdersController Test Case
 *
 */
class OrdersControllerTestCase extends ControllerTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product', 'app.order', 'app.currency');
    public $autoFixtures = true;
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		//$this->Orders = new TestOrdersController();
		//$this->Orders->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Orders);

		parent::tearDown();
	}
/**
*testIndex method
*
*@return void
**/
    public function testIndex(){
		$this->testAction('/orders/index');
		$this->assertEquals(1, sizeof($this->vars['products']));
		$this->assertEquals(6, sizeof($this->vars['currencies']));
        $this->assertEquals(3, sizeof($this->vars['creditCards']));    
    }

    public function testCheckout(){
    	$post_data = array('Order'=> array('product_id'=>'1', 'customer_name' => 'fname lname'),
    						'Product'=>array('currency'=>'USD'));
		$this->testAction("/orders/checkout", 
                  array('data' => $post_data, 'method' => 'post'));
		$this->assertEquals(1, sizeof($this->vars['orderDetail']));
		$this->assertEquals(1, sizeof($this->vars['currency']));
		$this->assertEquals(3, sizeof($this->vars['creditCards']));
    }

    public function testProcess_payment(){
    	$post_data = array('Order'=> array('product_id'=>'1', 'customer_name' => 'fname lname',
    							'customer_name'=>'test user','currency_abbr'=>'USD','title'=>'iphone 5',
    							'amount'=>'649','cc_holder_name'=>'fname lname','cc_number'=>'5540362606447441',
    							'cc_expiration'=>'112017','cc_cvv'=>'123','cc_type'=>'MASTER CARD'));
    	$this->testAction("/orders/process_payment", 
                  array('data' => $post_data, 'method' => 'post'));
    	$this->assertNotEmpty($this->vars['process']);

    }

}
?>