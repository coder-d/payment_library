<?php
App::uses('Currency', 'Model');

/**
 * Currency Test Case
 *
 */
class CurrencyTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.currency');

	/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Currency = ClassRegistry::init('Currency');
	}


	public function testGetCurrencyByAbbreviation(){
		$result = $this->Currency->getCurrencyByAbbreviation('USD'); 
		$expected = array('id' => '1','abbreviation' => 'USD','name'=>'US Dollar','rate'=>'1',
							'default'=>'1','created' => '2016-01-16 11:32:34','modified' => '0000-00-00 00:00:00');       
        $this->assertContains($expected, $result);
	}



}