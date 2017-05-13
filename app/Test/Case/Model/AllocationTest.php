<?php
App::uses('Allocation', 'Model');

/**
 * Allocation Test Case
 *
 */
class AllocationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.allocation',
		'app.client',
		'app.user',
		'app.level',
		'app.levelvalue',
		'app.role',
		'app.clients_user',
		'app.group',
		'app.groups_client',
		'app.groups_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Allocation = ClassRegistry::init('Allocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Allocation);

		parent::tearDown();
	}

}
