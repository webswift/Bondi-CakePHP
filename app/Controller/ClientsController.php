<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ClientsController extends AppController {

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
		$this->Client->recursive = 0;
		$this->set('clients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();

			$logo_url = $this->uploadImage($this->request->data['Client']['name']);
			$new_user = $this->request->data;

			if($logo_url == 'upload error') {
				$new_user['Client']['logo_url'] = 'NoPhoto';
			} else {
				$new_user['Client']['logo_url'] = $logo_url;
			}

			if ($this->Client->save($new_user)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
		$users = $this->Client->User->find('list');
		$groups = $this->Client->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$logo_url = $this->uploadImage($this->request->data['Client']['name']);

			$new_user = $this->request->data;
			
			if($logo_url == 'upload error') {
				$new_user['Client']['logo_url'] = 'NoPhoto';
			} else {
				$new_user['Client']['logo_url'] = $logo_url;
			}

			if ($this->Client->save($new_user)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
		$users = $this->Client->User->find('list');
		$groups = $this->Client->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('The client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function uploadImage($name){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->request->data['Client']) {
				$image = $this->request->data['Client']['logo_url'];

				//allowed image types
				$imageTypes = array("image/gif", "image/jpeg", "image/png");
				//upload folder - make sure to create one in webroot
				$uploadFolder = "upload";
				//full path to upload folder
				$uploadPath = WWW_ROOT . $uploadFolder;


				//check if image type fits one of allowed types
				foreach ($imageTypes as $type) {
					if ($type == $image['type']) {
						//check if there wasn't errors uploading file on serwer
						if ($image['error'] == 0) {
							//image file name
							$imageName = 'bondi' . date('His') . $name;


//							//check if file exists in upload folder
//							if (file_exists($uploadPath . '/' . $imageName)) {
//								//create full filename with timestamp
//								$imageName = 'bondi' . date('His') . $imageName;
//							}
							//create full path with image name
							$full_image_path = $uploadPath . '/' . $imageName;
							//upload image to upload folder
							if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
								$this->Session->setFlash('File saved successfully');
								$this->set('imageName',$imageName);

								return $imageName;
							} else {
								$this->Session->setFlash('There was a problem uploading file. Please try again.');
								return 'upload error';
							}
						} else {
							$this->Session->setFlash('Error uploading file.');
							return 'upload error';
						}
						break;
					} else {
						$this->Session->setFlash('Unacceptable file type');
//						return 'upload error';
					}
				}
				return 'upload error';
			}
		}
		//		$this->render('add');
	}
}
