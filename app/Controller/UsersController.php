<?php
require_once WWW_ROOT . DS . 'files' . DS . 'adminInfo.php';

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session');
	var $components1=array("Email","Session");
	var $helpers=array("Html","Form","Session");

/**
 * index method
 *
 * @return void
 */


	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();

			debug($this->request->data);

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
//				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$levels = $this->User->Level->find('list');
		$levelvalues = $this->User->Levelvalue->find('list');
		$roles = $this->User->Role->find('list');
		$clients = $this->User->Client->find('list');
		$groups = $this->User->Group->find('list');
		$this->set(compact('levels', 'levelvalues', 'roles', 'clients', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$levels = $this->User->Level->find('list');
		$levelvalues = $this->User->Levelvalue->find('list');
		$roles = $this->User->Role->find('list');
		$clients = $this->User->Client->find('list');
		$groups = $this->User->Group->find('list');
		$this->set(compact('levels', 'levelvalues', 'roles', 'clients', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	private function getHeaderInfo($userGroup)
	{
		$adminInfo = null;
		$groupInfo = null;
		$clientInfo = null;

		if ($userGroup == null || $userGroup == "")
		{
//			$adminInfo = $adminConfig;

			// Checkpoint 3 :
			// debug($adminInfo);
		}
		else {
			// Find userGroup Information in Group
			$this->loadModel('Group');
			$groupInfo = $this->Group->find('first', array('recursive' => -1,
				'conditions' => array('Group.name' => $userGroup)));

			// If userGroup is not member of Group
			if ($groupInfo == null) {
				// Find userGroup Information in Client
				$this->loadModel('Client');
				$clientInfo = $this->Client->find('first', array('recursive' => -1,
					'conditions' => array('Client.name' => $userGroup)));

				if ($clientInfo != null) {
					$this->loadModel('GroupsClient');
					$groupID = $this->GroupsClient->find('first', array('recursive' => -1,
						'conditions' => array('GroupsClient.group_id' => $clientInfo['Client']['id'])));

					if ($groupID != null) {
						$groupInfo = $this->Group->find('first', array('recursive' => -1,
							'conditions' => array('Group.id' => $groupID['GroupsClient']['id'])));
					}
				}
			}
		}

		// checkpoint 2 :
//		debug($groupInfo);
//		debug($clientInfo);

		$this->Session->write('adminInfo', $adminInfo == null ? null : $adminInfo);
		$this->Session->write('groupInfo', $groupInfo == null ? null : $groupInfo['Group']);
		$this->Session->write('clientInfo', $clientInfo == null ? null : $clientInfo['Client']);

		$this->Session->Write('workingGroupID', $groupInfo == null ? '0' : $groupInfo['Group']['id']);
		$this->Session->Write('workingClientID', $clientInfo == null ? '0' : $clientInfo['Client']['id']);

//		Configure::write('adminInfo', $adminInfo == null ? null : $adminInfo);
//		Configure::write('groupInfo', $groupInfo == null ? null : $groupInfo['Group']);
//		Configure::write('clientInfo', $clientInfo == null ? null : $clientInfo['Client']);

//		$this->set('adminInfo', $adminInfo == null ? null : $adminInfo);
//		$this->set('groupInfo', $groupInfo == null ? null : $groupInfo['Group']);
//		$this->set('clientInfo', $clientInfo == null ? null : $clientInfo['Client']);
	}

	public function login()
	{
		//debug($this->params['userGroup']);
		$this->Auth->logout();

		//if already logged-in, redirect
		if($this->Session->check('Auth.User'))
		{
			$this->redirect('index');
		}

//		debug($this->params['userGroup']);
		$userGroup = $this->params['userGroup'];

		$this->getHeaderInfo($userGroup);

		$groupInfo = $this->Session->read('groupInfo');
		$clientInfo = $this->Session->read('clientInfo');

		// if we get the post information, try to authenticate
		if ($this->request->is('post'))
		{
			$userName = $this->request->data['User']['username'];

			include("/../connect_db.php");

			$sqlQuery = ';';
			$errorString = '';

			if ($groupInfo != null && $clientInfo == null)
			{
				$sqlQuery = "SELECT users.id, users.role_id FROM users, groups_users " .
					"WHERE users.id = groups_users.user_id AND groups_users.group_id = " . $groupInfo['id'] . " AND users.username = '" . $userName . "';";
				$errorString = "This User is not member of Group(".$groupInfo['name'].") or Invalid Username.";
			}
			else if ($clientInfo != null)
			{
				$sqlQuery = "SELECT users.id, users.role_id FROM users, clients_users " .
					"WHERE users.id = clients_users.user_id AND clients_users.client_id = " . $clientInfo['id'] . " AND users.username = '" . $userName . "';";
				$errorString = "This User is not member of Client(".$clientInfo['name'].") or Invalid Username.";
			}
			else
			{
				$sqlQuery = "SELECT users.id, users.role_id FROM users WHERE users.username = '" . $userName . "' AND users.role_id = 1;";
				$errorString = "This User is not Administrator or Invalid Username.";
			}

			$result = mysqli_query($conn, $sqlQuery);

//			debug($sqlQuery);
//			debug($result);

			if (mysqli_num_rows($result) == 0)
				$this->Session->setFlash(__($errorString));
			else if ($this->Auth->login())
			{
				$user_all = $this->Auth->user();
				$user_id = $user_all['id'];
//				debug ($this->Auth->user());

				$this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));

				// Get the User Information
				$userInfo = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $user_id)));

				// Save FL state and login Date
				$userInfo['User']['FL'] = 1;
				$userInfo['User']['login_state'] = 1;
				$userInfo['User']['login_date'] = date('Y-m-d H:i:s');

				$this->User->save($userInfo, true, array('FL', 'login_state', 'login_date'));

				$this->Session->write('userInfo', $userInfo['User']);
				$this->Session->write('userRole', $userInfo['User']['role_id']);
				$this->Session->Write('workingUserID', $userInfo['User']['id']);

				$this->redirect('index');
			}
			else
				$this->Session->setFlash(__('Invalid username or password'));
		}
	}

	public function logout()
	{
		$user_all = $this->Auth->user();
		$this->Session->write('userInfo', null);

		if (!empty($user_all))
		{
			$user_id = $user_all['id'];
			$this->User->create();
			$edit_user = array('id'=>$user_id, 'login_state'=>0, 'logoff_date'=> date('Y-m-d H:i:s'));

			if (!$this->User->save($edit_user, true, array('login_state', 'logoff_date')))
			{
				$this->Session->setFlash(__('login state edit fail'));
				$this->redirect('login');
			}
		}

		$this->redirect($this->Auth->logout());
	}

	public function isAuthorized($user) {
		// Here is where we should verify the role and give access based on role

		return true;
	}
}
