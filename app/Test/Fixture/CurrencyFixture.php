<?php
/**
 * CurrennyProductFixture
 *
 */
class CurrencyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'abbreviation' => array('type' => 'string', 'null' =>false, 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' =>false, 'length' => 255, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'rate' => array('type' => 'float', 'null' => false),
		'default' => array('type' => 'integer', 'null' => false,'default'=>0),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		
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
			'abbreviation' => 'USD',
			'name' => 'US Dollar',
			'rate' => '1.00',
			'default' =>'1',
			'created' => '2016-01-16 11:32:34',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '2',
			'abbreviation' => 'EUR',
			'name' => 'EURO',
			'rate' => '0.92',
			'default' =>'0',
			'created' => '2016-01-16 11:33:11',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '3',
			'abbreviation' => 'THB',
			'name' => 'Thai Bhat',
			'rate' => '36.33',
			'default' =>'0',
			'created' => '2016-01-16 11:32:34',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '4',
			'abbreviation' => 'HKD',
			'name' => 'Hong Kong Dollar',
			'rate' => '7.79',
			'default' =>'0',
			'created' => '2016-01-16 11:36:06',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '5',
			'abbreviation' => 'SGD',
			'name' => 'Singapore Dollar',
			'rate' => '1.44',
			'default' =>'0',
			'created' => '2016-01-16 11:37:19',
			'modified' => '0000-00-00 00:00:00'
		),
		array(
			'id' => '6',
			'abbreviation' => 'AUD',
			'name' => 'Australian Dollar',
			'rate' => '1.46',
			'default' =>'0',
			'created' => '2016-01-16 11:37:19',
			'modified' => '0000-00-00 00:00:00'
		)
	);
}
