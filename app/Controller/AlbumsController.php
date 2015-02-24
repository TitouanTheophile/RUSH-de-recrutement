<?php 
class AlbumsController extends AppController {
	
	public function index($id) {
		if (!$id)
			throw new NotFoundException(__('Album introuvable'));
		$friends_verification = $this->requestAction('friends/isFriend',
													 array('pass' => array($this->Session->read('Auth.User.id'), $id)));
		if ($friends_verification != 1 && $id != $this->Session->read('Auth.User.id')) {
			$this->Session->setFlash(__('Vous n\'êtes pas autorisé à voir cet album.'));
			$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		}
		$albums = $this->Album->find('all', array(
			"conditions" => array("Album.user_id" => $id),
			"fields" => array("Album.id", "Album.title", "Album.description")));
		$this->set('albums', $albums);
		$this->set('user', $this->Album->User->findById($id));
	}

	public function newAlbum() {
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->Album->create(array(
				'user_id' => $this->Session->read('Auth.User.id'),
				'title' => $this->request->data['Album']['title'],
				'description' => $this->request->data['Album']['description']));
			if ($this->Album->save(null, true, array('user_id', 'title', 'description')))
                $this->Session->setFlash(__('Votre album a été créé.'));
            else
            	$this->Session->setFlash(__('Erreur lors de la création de l\'album'));
            $this->redirect(array('controller' => 'albums', 'action' => 'index', $this->Session->read('Auth.User.id')));
		}
	}

	public function editAlbum($id) {
		if (!$id)
			throw new NotFoundException(__('Album introuvable'));
		$album = $this->Album->findById($id);
		if (!$album) 
			throw new NotFoundException(__('Album introuvable'));
		$owner = $this->Album->User->findById($album['Album']['user_id']);
		$friends_verification = $this->requestAction('friends/isFriend',
													 array('pass' => array($this->Session->read('Auth.User.id'), $owner)));
		if ($friends_verification != 1 && $owner != $this->Session->read('Auth.User.id')) {
			$this->Session->setFlash(__('Vous n\'êtes pas autorisé à modifier cet album.'));
			$this->redirect(array('controller' => 'users', 'action' => 'album', $id));
		}
		if ($this->request->is('put') && !empty($this->request->data)) {
			$this->Album->create(array(
			'id' => $id,
			'title' => $this->request->data['Album']['title'],
			'description' => $this->request->data['Album']['description']));
			if ($this->Album->save(null, false, array('title', 'description')))
                $this->Session->setFlash(__('Vos modifications ont été enregistrées.'));
            else
            	$this->Session->setFlash(__('Erreur lors de la modification de l\'album'));
            $this->redirect(array('controller' => 'albums', 'action' => 'index', $this->Session->read('Auth.User.id')));
		}
		if (empty($this->request->data))
			$this->request->data = $album;
	}

	public function delAlbum($id) {
		if (!$id)
			throw new NotFoundException(__('Album introuvable'));
		$album = $this->Album->findById($id);
		if (!$album)
			throw new NotFoundException(__('Album introuvable'));
		$owner = $this->Album->User->findById($album['Album']['user_id']);
		$friends_verification = $this->requestAction('friends/isFriend',
													 array('pass' => array($this->Session->read('Auth.User.id'), $owner)));
		if ($friends_verification != 1 && $owner != $this->Session->read('Auth.User.id')) {
			$this->Session->setFlash(__('Vous n\'êtes pas autorisé à supprimer cet album.'));
			$this->redirect(array('controller' => 'users', 'action' => 'album', $id));
		}
		$this->Album->Picture->deleteAll(array('Picture.album_id' => $id), false);
		$this->Album->delete($id);
		$this->Session->setFlash(__('Votre album a bien été supprimé.'));
        $this->redirect(array('action' => 'index'));
	}

	public function album($album) {
		$pics = $this->Album->Picture->find('all', array(
			 "fields" => array("DISTINCT Picture.id", "Picture.description"),
			 "conditions" => array("Album.id" => $album)
			));
		$album = $this->Album->findById($album);
		$owner = $this->Album->User->findById($album['Album']['user_id']);
		$this->set('pics', $pics);
		$this->set('album', $album);
		$this->set('owner', $owner);
	}
}
 ?>
