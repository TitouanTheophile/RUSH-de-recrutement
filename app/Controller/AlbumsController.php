<?php 
class AlbumsController extends AppController {
	
	public function index() {
		$this->Session->write('id', '2');
		$albums = $this->Album->find('all', array(
			"conditions" => array("Album.profile_id" => $this->Session->read('id')),
			"fields" => array("Album.id", "Album.title", "Album.description")));
		$this->set('albums', $albums);
	}

	public function newAlbum() {
		$this->Session->write('id', '2');
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->Album->create(array(
				'profile_id' => $this->Session->read('id'),
				'title' => $this->request->data['Album']['title'],
				'description' => $this->request->data['Album']['description']));
			if ($this->Album->save(null, true, array('profile_id', 'title', 'description'))) {
                $this->Session->setFlash(__('Votre album a été créé.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur lors de la création de l\'album'));
		}
	}

	public function editAlbum($id) {
		$this->Session->write('id', '2');
		if (!$id) {throw new NotFoundException(__('Album introuvable'));}
		$album = $this->Album->findById($id);
		if (!$album) {throw new NotFoundException(__('Album introuvable'));}
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
		if (!$id) {throw new NotFoundException(__('Album introuvable'));}
		$album = $this->Album->findById($id);
		if (!$album) {throw new NotFoundException(__('Album introuvable'));}
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
		$title = $this->Album->findById($album);
		$this->set('title', $title["Album"]["title"]);
		$this->set('description', $title["Album"]["description"]);
		$this->set('pics', $pics);
		$this->set('album', $album);
	}
}
 ?>
