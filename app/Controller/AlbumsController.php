<?php 
class AlbumsController extends AppController {
	
	public function index($id) {
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
			if ($this->Album->save(null, true, array('user_id', 'title', 'description'))) {
                $this->Session->setFlash(__('Votre album a été créé.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur lors de la création de l\'album'));
		}
	}

	public function editAlbum($id) {
		if (!$id)
			throw new NotFoundException(__('Album introuvable'));
		$album = $this->Album->findById($id);
		if (!$album) 
			throw new NotFoundException(__('Album introuvable'));
		if ($album['user_id'] != $this->Session->read('Auth.User.id'))
			throw new NotAllowedException(__('Vous n\'êtes pas à modifier cet album.'));
		if ($this->request->is('put') && !empty($this->request->data)) {
			$this->Album->create(array(
			'id' => $id,
			'title' => $this->request->data['Album']['title'],
			'description' => $this->request->data['Album']['description']));
			if ($this->Album->save(null, false, array('title', 'description'))) {
                $this->Session->setFlash(__('Vos modifications ont été enregistrées.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur lors de la modification de l\'album'));
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
		if ($album['user_id'] != $this->Session->read('Auth.User.id'))
			throw new NotAllowedException(__('Vous n\'êtes pas autorisé à supprimer cet album.'));
		$this->Album->Picture->deleteAll(array('Picture.album_id' => $id), false);
		$this->Album->delete($id);
		$this->Session->setFlash(__('Votre album a bien été supprimé.'));
        return $this->redirect(array('action' => 'index'));
	}

	public function album($album) {
		$pics = $this->Album->Picture->find('all', array(
			 "fields" => array("DISTINCT Picture.id", "Picture.description"),
			 "conditions" => array("Album.id" => $album)
			));
		$album = $this->Album->findById($album);
		// $this->set('title', $album["Album"]["title"]);
		// $this->set('description', $album["Album"]["description"]);
		$this->set('pics', $pics);
		$this->set('album', $album);

	}
}
 ?>
