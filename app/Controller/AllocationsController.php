<?php
App::uses('AppController', 'Controller');
/**
 * Allocations Controller
 *
 * @property Allocation $Allocation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AllocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Allocation->recursive = 0;
		$this->set('allocations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Allocation->exists($id)) {
			throw new NotFoundException(__('Invalid allocation'));
		}
		$options = array('conditions' => array('Allocation.' . $this->Allocation->primaryKey => $id));
		$this->set('allocation', $this->Allocation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->request->data['Allocation']['client_id'] = $this->Session->read('workingClientID');

			$this->Allocation->create();
			if ($this->Allocation->save($this->request->data)) {
				$this->Session->setFlash(__('The allocation has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The allocation could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Allocation->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Allocation->exists($id)) {
			throw new NotFoundException(__('Invalid allocation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Allocation->save($this->request->data)) {
				$this->Session->setFlash(__('The allocation has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The allocation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Allocation.' . $this->Allocation->primaryKey => $id));
			$this->request->data = $this->Allocation->find('first', $options);
		}
		$clients = $this->Allocation->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Allocation->id = $id;
		if (!$this->Allocation->exists()) {
			throw new NotFoundException(__('Invalid allocation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Allocation->delete()) {
			$this->Session->setFlash(__('The allocation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The allocation could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function getAllocationListInClient()
	{
		$clientID = $_POST['clientID'];
		$this->Session->write('workingClientID', $clientID);

		$options = array('conditions' => array('client_id' => $clientID));
		$allocations = $this->Allocation->find('all', $options);

		$values = array();

		foreach ($allocations as $allocation)
			$values[] = $allocation['Allocation'];

		echo json_encode(array('count' => sizeof($values), 'data' => $values));
		exit;
	}
}
