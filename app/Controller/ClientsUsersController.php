<?php
App::uses('AppController', 'Controller');
/**
 * ClientsUsers Controller
 *
 * @property ClientsUser $ClientsUser
 * @property PaginatorComponent $Paginator
 */
class ClientsUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ClientsUser->recursive = 0;
		$this->set('clientsUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientsUser->exists($id)) {
			throw new NotFoundException(__('Invalid clients user'));
		}
		$options = array('conditions' => array('ClientsUser.' . $this->ClientsUser->primaryKey => $id));
		$this->set('clientsUser', $this->ClientsUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientsUser->create();
			if ($this->ClientsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The clients user has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The clients user could not be saved. Please, try again.'));
			}
		}
		$clients = $this->ClientsUser->Client->find('list');
		$users = $this->ClientsUser->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientsUser->exists($id)) {
			throw new NotFoundException(__('Invalid clients user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The clients user has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The clients user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ClientsUser.' . $this->ClientsUser->primaryKey => $id));
			$this->request->data = $this->ClientsUser->find('first', $options);
		}
		$clients = $this->ClientsUser->Client->find('list');
		$users = $this->ClientsUser->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientsUser->id = $id;
		if (!$this->ClientsUser->exists()) {
			throw new NotFoundException(__('Invalid clients user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ClientsUser->delete()) {
			$this->Session->setFlash(__('The clients user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The clients user could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function getUserListInClient()
	{
		$clientID = $_POST['clientID'];
		$this->Session->write('workingClientID', $clientID);

		$options = array('conditions' => array('client_id' => $clientID));
		$users = $this->ClientsUser->find('all', $options);

		$values = array();

		foreach ($users as $user){
			$values[] = array('id' => $user['ClientsUser']['id'],
				'userID' => $user['User']['id'], 'userName' => $user['User']['username'],
				'clientID' => $user['Client']['id'], 'clientName' => $user['Client']['name']);
		}

		echo json_encode(array('count' => sizeof($values), 'users' => $values));
		exit;
	}
}
