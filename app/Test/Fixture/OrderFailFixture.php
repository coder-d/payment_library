<?php
/**
 * OrderFailFixture
 *
 */
class OrderFailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'title' => array('type' => 'blob', 'null' =>true),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'error' => array('type' => 'string', 'null' =>false, 'length' => 255, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'payment_gateway' => array('type' => 'string', 'null' =>false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);



/**
 * Records
 *
 * @var array
 */
	
}
