<?php
App::uses('AppController', 'Controller');
/**
 * Levelvalues Controller
 *
 * @property Levelvalue $Levelvalue
 * @property PaginatorComponent $Paginator
 */
class LevelvaluesController extends AppController {

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
		$this->Levelvalue->recursive = 0;
		$this->set('levelvalues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Levelvalue->exists($id)) {
			throw new NotFoundException(__('Invalid levelvalue'));
		}
		$options = array('conditions' => array('Levelvalue.' . $this->Levelvalue->primaryKey => $id));
		$this->set('levelvalue', $this->Levelvalue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Levelvalue->create();
			if ($this->Levelvalue->save($this->request->data)) {
				$this->Session->setFlash(__('The levelvalue has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The levelvalue could not be saved. Please, try again.'));
			}
		}
		$levels = $this->Levelvalue->Level->find('list');
		$this->set(compact('levels'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Levelvalue->exists($id)) {
			throw new NotFoundException(__('Invalid levelvalue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Levelvalue->save($this->request->data)) {
				$this->Session->setFlash(__('The levelvalue has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The levelvalue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Levelvalue.' . $this->Levelvalue->primaryKey => $id));
			$this->request->data = $this->Levelvalue->find('first', $options);
		}
		$levels = $this->Levelvalue->Level->find('list');
		$this->set(compact('levels'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Levelvalue->id = $id;
		if (!$this->Levelvalue->exists()) {
			throw new NotFoundException(__('Invalid levelvalue'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Levelvalue->delete()) {
			$this->Session->setFlash(__('The levelvalue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The levelvalue could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function getLevelValuesByLevelID()
	{
		$level_id = $_POST['level_id'];
		$options = array('conditions' => array('level_id' => $level_id));

		$find_levelvalues = $this->Levelvalue->find('all', $options);

		if (empty($find_levelvalues))
		{
			echo json_decode("empty value");
			exit;
		}

		$name = array();

		foreach ($find_levelvalues as $find_levelvalue){
			$name[] = array('id' => $find_levelvalue['Levelvalue']['id'], 'name' => $find_levelvalue['Levelvalue']['name']);
		}

		echo json_encode(array('levelvalues' => $name));
		exit;
	}

	public function getAllLevelValues()
	{
		$levelvalues = $this->Levelvalue->find('all');

		if (empty($levelvalues))
		{
			echo json_decode("empty value");
			exit;
		}

		$values = array();

		foreach ($levelvalues as $levelvalue){
			$values[] = array('id' => $levelvalue['Levelvalue']['id'],
							  'name' => $levelvalue['Levelvalue']['name'],
							  'level_id' => $levelvalue['Levelvalue']['level_id']);
		}

		echo json_encode(array('levelvalues' => $values));
		exit;
	}
}
