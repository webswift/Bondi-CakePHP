<?php
App::uses('AppController', 'Controller');
/**
 * GroupsClients Controller
 *
 * @property GroupsClient $GroupsClient
 * @property PaginatorComponent $Paginator
 */
class GroupsClientsController extends AppController {

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
		$this->GroupsClient->recursive = 0;
		$this->set('groupsClients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupsClient->exists($id)) {
			throw new NotFoundException(__('Invalid groups client'));
		}
		$options = array('conditions' => array('GroupsClient.' . $this->GroupsClient->primaryKey => $id));
		$this->set('groupsClient', $this->GroupsClient->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupsClient->create();
			if ($this->GroupsClient->save($this->request->data)) {
				$this->Session->setFlash(__('The groups client has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The groups client could not be saved. Please, try again.'));
			}
		}
		$groups = $this->GroupsClient->Group->find('list');
		$clients = $this->GroupsClient->Client->find('list');
		$this->set(compact('groups', 'clients'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupsClient->exists($id)) {
			throw new NotFoundException(__('Invalid groups client'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupsClient->save($this->request->data)) {
				$this->Session->setFlash(__('The groups client has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The groups client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupsClient.' . $this->GroupsClient->primaryKey => $id));
			$this->request->data = $this->GroupsClient->find('first', $options);
		}
		$groups = $this->GroupsClient->Group->find('list');
		$clients = $this->GroupsClient->Client->find('list');
		$this->set(compact('groups', 'clients'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GroupsClient->id = $id;
		if (!$this->GroupsClient->exists()) {
			throw new NotFoundException(__('Invalid groups client'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->GroupsClient->delete()) {
			$this->Session->setFlash(__('The groups client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups client could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function getClientListInGroup()
	{
		$groupID = $_POST['groupID'];
		$this->Session->write('workingGroupID', $groupID);

		$options = array('conditions' => array('group_id' => $groupID));
		$clients = $this->GroupsClient->find('all', $options);

		$values = array();

		foreach ($clients as $client){
			$values[] = array('id' => $client['GroupsClient']['id'],
				'client_id' => $client['Client']['id'], 'clientName' => $client['Client']['name'],
				'group_id' => $client['Group']['id'], 'groupName' => $client['Group']['name']);
		}

		echo json_encode(array('count' => sizeof($values), 'clients' => $values));
		exit;
	}
}
