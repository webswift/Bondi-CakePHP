<?php
App::uses('GroupsUser', 'Model');

/**
 * GroupsUser Test Case
 *
 */
class GroupsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.groups_user',
		'app.group',
		'app.client',
		'app.user',
		'app.level',
		'app.levelvalue',
		'app.clients_user',
		'app.groups_client'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupsUser = ClassRegistry::init('GroupsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupsUser);

		parent::tearDown();
	}

}
