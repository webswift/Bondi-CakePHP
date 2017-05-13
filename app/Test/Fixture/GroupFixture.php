<?php
/**
 * GroupFixture
 *
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'contact' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'logo_url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
		'login_url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'ascii_general_ci', 'charset' => 'ascii'),
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
			'name' => 'Lorem ipsum dolor ',
			'email' => 'Lorem ipsum dolor sit amet',
			'contact' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'logo_url' => 'Lorem ipsum dolor sit amet',
			'login_url' => 'Lorem ipsum dolor sit amet'
		),
	);

}
