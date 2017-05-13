<?php
App::uses('ClientsUser', 'Model');

/**
 * ClientsUser Test Case
 *
 */
class ClientsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.clients_user',
		'app.client',
		'app.user',
		'app.level',
		'app.levelvalue',
		'app.group',
		'app.groups_user',
		'app.groups_client'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientsUser = ClassRegistry::init('ClientsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientsUser);

		parent::tearDown();
	}

}
