<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

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
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();

			$logo_url = $this->uploadImage($this->request->data['Group']['name']);

			$new_user = $this->request->data;

			if($logo_url == 'upload error') {
				$new_user['Group']['logo_url'] = 'NoPhoto';
			} else {
				$new_user['Group']['logo_url'] = $logo_url;
			}

			if ($this->Group->save($new_user)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Group->Client->find('list');
		$users = $this->Group->User->find('list');
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
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$logo_url = $this->uploadImage($this->request->data['Group']['name']);

			$new_user = $this->request->data;

			if($logo_url == 'upload error') {
				$new_user['Group']['logo_url'] = 'NoPhoto';
			} else {
				$new_user['Group']['logo_url'] = $logo_url;
			}

			if ($this->Group->save($new_user)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect('index');
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		}
		$clients = $this->Group->Client->find('list');
		$users = $this->Group->User->find('list');
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect('index');
	}

	public function uploadImage($name){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->request->data['Group']) {
				$image = $this->request->data['Group']['logo_url'];

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
