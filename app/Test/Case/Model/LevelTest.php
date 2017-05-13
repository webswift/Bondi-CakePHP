<?php
App::uses('Level', 'Model');

/**
 * Level Test Case
 *
 */
class LevelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.level',
		'app.levelvalue',
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
		$this->Level = ClassRegistry::init('Level');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Level);

		parent::tearDown();
	}

}
