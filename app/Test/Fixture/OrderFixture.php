<?php
/**
 * OrderFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'amount' => array('type' => 'float', 'null' => false),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);



/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'created' => '2016-01-16 06:17:57',
			'modified' => '0000-00-00 00:00:00',
			'amount' => '649.00',
			'product_id' =>'1',
			'currency_id' =>'1'
		)
	);
}
