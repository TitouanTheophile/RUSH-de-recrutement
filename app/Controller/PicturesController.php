<?php

class PicturesController extends AppController {

	public function view($img_id)
	{
		$this->try_arg((!isset($img_id) || $img_id <= 0), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		$pic = $this->Picture->find('first', array(
			'conditions' => array(
				'Picture.id' => $img_id
				),
			'contain' => array(
				'Content' => array(
					"Points" => array(
						'conditions' => array(
							'Points.content_id' => 'Content.id',
							'Points.user_id' => $this->Session->read('Auth.User.id')
							),
						'fields' => array('Points.user_id', 'Points.pointType')
						),
					'LikeP',
					'ConnardP'
					),
				'Album'
				)
			)
		);
		$this->allowFriend($pic['Content']['from_id'], 'Vous n\'êtes pas autorisé à voir cette image.');
		$this->set('pic', $pic);
		$this->set('user', $this->Session->read('Auth.User.id'));
	}

	public function next($img_id)
	{
		$this->try_arg((!isset($img_id) || $img_id <= 0), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		$album = $this->Picture->findById($img_id);
		$album = $album['Picture']['album_id'];
		$this->try_arg(empty($album), '', $this->referer());
		$next_id = $img_id + 1;
		$current = $this->Picture->findById($next_id);
		$end = $this->Picture->find('first', array(
			'order' => 'Picture.id desc'));
		$end = $end['Picture']['id'];
		while (empty($current) || $current['Picture']['album_id'] != $album)
			{
				$next_id = ($next_id >= $end ? 1 : $next_id + 1);
				$current = $this->Picture->findById($next_id);
				if ($next_id == $img_id)
					$this->redirect($this->referer());
			}
		$this->redirect(array('controller' => 'pictures', 'action' => 'view', $next_id));
	}

	public function previous($img_id)
	{
		$this->try_arg((!isset($img_id) || $img_id <= 0), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		$album = $this->Picture->findById($img_id);
		$album = $album['Picture']['album_id'];
		$this->try_arg(empty($album), '', $this->referer());
		$previous_id = $img_id - 1;
		$current = $this->Picture->findById($previous_id);
		$end = $this->Picture->find('first', array(
			'order' => 'Picture.id desc'));
		$end = $end['Picture']['id'];
		while (empty($current) || $current['Picture']['album_id'] != $album)
			{
				$previous_id = ($previous_id <= 0 ? $end : $previous_id - 1);
				$current = $this->Picture->findById($previous_id);
				if ($previous_id == $img_id)
					$this->redirect($this->referer());
			}
		$this->redirect(array('controller' => 'pictures', 'action' => 'view', $previous_id));
	}

	public function add($album = null)
	{
		if ($this->request->is('post') && !empty($this->request->data))
			{
				$this->Picture->create();
				$pic_data = array(
						'album_id' => $album,
						'description' => $this->request->data['Picture']['description']);
				if (!($this->Picture->save($pic_data)))
					{
						$this->Session->setFlash(__('Erreur lors de l\'ajout de l\'image'));
						$this->redirect(array('controller' => 'pictures', 'action' => 'add'));
					}
				$pic_id = $this->Picture->id;
				move_uploaded_file($this->request->data['Picture']['img']['tmp_name'], WWW_ROOT . "/img/$pic_id.jpg");
				$this->Picture->Content->create();
				$content_data = array(
						'contentType_id' => 2,
						'targetType_id' => 1,
						'content_id' => $this->Picture->id,
						'from_id' => $this->Session->read('Auth.User.id'),
						'target_id' => $this->Session->read('Auth.User.id'),
						'points_like' => 0,
						'points_connard' => 0);
				if (!($this->Picture->Content->save($content_data)))
					{
						$this->Session->setFlash(__('Erreur lors de l\'ajout de l\'image'));
						$this->redirect(array('controller' => 'pictures', 'action' => 'add'));
					}
        	    $this->Session->setFlash(__('Votre image a été ajoutée.'));
        	    $this->redirect(array('controller' => 'albums', 'action' => 'album', $album));
			}
	}

	public function edit($img_id, $album)
	{
		$this->try_arg((!isset($img_id) || $img_id <= 0), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		$pic = $this->Picture->findById($img_id);
		$this->try_arg((!isset($pic) || empty($pic)), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		if ($this->request->is('put') && !empty($this->request->data))
			{
				$this->Picture->create(array(
					'id' => $img_id,
					'album_id' => $album,
					'description' => $this->request->data['Picture']['description']));
				if ($this->Picture->save(null, false, array('description')))
					{
        	    	    $this->Session->setFlash(__('Vos modifications ont été enregistrées.'));
        	    	    $this->redirect(array('action' => 'view', $img_id));
        	    	}
        	    $this->Session->setFlash(__('Erreur lors de la modification de l\'image'));
			}
		if (empty($this->request->data))
			{
				$this->set('id', $img_id);
				$this->request->data = $pic;
			}
	}

	public function delete($img_id, $album)
	{
		$this->try_arg((!isset($img_id) || $img_id <= 0), 'Image introuvable',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		$content_id = $this->Picture->Content->find('first', array(
			'conditions' => array(
			"Content.content_id" => $img_id)));
		$content_id = $content_id['Content']['id'];
		$this->Picture->Content->ContentP->deleteAll(array(
			'ContentP.content_id' => $content_id));
		$this->Picture->delete($img_id, true);
		$this->Picture->Content->delete($content_id, true);
		if (file_exists(WWW_ROOT . "/img/$id.jpg"))
			unlink(WWW_ROOT . "/img/$id.jpg");
		$this->Session->setFlash(__('Votre image a été supprimée.'));
		$this->redirect(array('controller' => 'albums', 'action' => 'album', $album));
	}

}
?>