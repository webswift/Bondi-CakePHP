<?php
App::uses('Levelvalue', 'Model');

/**
 * Levelvalue Test Case
 *
 */
class LevelvalueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.levelvalue',
		'app.level',
		'app.user',
		'app.client',
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
		$this->Levelvalue = ClassRegistry::init('Levelvalue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Levelvalue);

		parent::tearDown();
	}

}
