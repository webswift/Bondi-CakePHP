<?php
/**
 * AllocationFixture
 *
 */
class AllocationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
		'serviceno' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level3' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level4' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level5' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level6' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level7' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level8' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level9' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'level10' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'split' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'ascii', 'collate' => 'ascii_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'client_id' => 1,
			'serviceno' => 'Lorem ipsum dolor sit amet',
			'alias' => 'Lorem ipsum dolor ',
			'level1' => 'Lorem ipsum dolor sit amet',
			'level2' => 'Lorem ipsum dolor sit amet',
			'level3' => 'Lorem ipsum dolor sit amet',
			'level4' => 'Lorem ipsum dolor sit amet',
			'level5' => 'Lorem ipsum dolor sit amet',
			'level6' => 'Lorem ipsum dolor sit amet',
			'level7' => 'Lorem ipsum dolor sit amet',
			'level8' => 'Lorem ipsum dolor sit amet',
			'level9' => 'Lorem ipsum dolor sit amet',
			'level10' => 'Lorem ipsum dolor sit amet',
			'split' => '',
			'email' => 'Lorem ipsum dolor sit amet'
		),
	);

}
