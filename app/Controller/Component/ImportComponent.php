<?php 

	class SecureImportComponent extends Component {
		
		public function moveFile($source, $target_name) {
			$img_info = getimagesize($source);
			if ($img_info['mime'] == 'image/jpeg') {
				move_uploaded_file($source, IMAGES . DS . $pic_id . ".jpg");
			}
		}

	}
?>