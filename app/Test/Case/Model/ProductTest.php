<?php
App::uses('Product', 'Model');

/**
 * Order Test Case
 *
 */
class ProductTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product');

	/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Product = ClassRegistry::init('Product');
	}


	public function testGetProductById(){
		$result = $this->Product->getProductById(1); 
		$expected = array('id' => '1','title'=> 'iphone 5','created' => '2016-01-16 11:40:16','modified' => '0000-00-00 00:00:00',
							'price' => '649');       
        $this->assertContains($expected, $result);
	}



}