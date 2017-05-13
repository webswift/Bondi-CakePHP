<?php
App::uses('GroupsClient', 'Model');

/**
 * GroupsClient Test Case
 *
 */
class GroupsClientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.groups_client',
		'app.group',
		'app.client',
		'app.user',
		'app.level',
		'app.levelvalue',
		'app.clients_user',
		'app.groups_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupsClient = ClassRegistry::init('GroupsClient');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupsClient);

		parent::tearDown();
	}

}
