<?php
class File {
	public function download($nombre){
	
		$path = PATH_FILES.$nombre;
		$type = '';

		if (is_file($path)) {
			$size = filesize($path);
			if (function_exists('mime_content_type')) {
				$type = mime_content_type($path);
			} else if (function_exists('finfo_file')) {
				$info = finfo_open(FILEINFO_MIME);
				$type = finfo_file($info, $path);
				finfo_close($info);
			}
			if ($type == '') {
				$type = "application/force-download";
			}
			header("Content-Type: $type");
			header("Content-Disposition: attachment; filename=$nombre");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . $size);
			readfile($path);
		} else {
			die("El archivo no existe.");
		}
	}
	
	public function uploadFile($prefix){
		$key = 'url';

		if(isset($_POST['fileName'])){
			
			if($_FILES['url1']['name']!=''){
				$key = 'url1';
				unlink(PATH_FILES.$_POST['fileName']);
			} else {
				return $_POST['fileName'];
			}					
		}			
		return $this->uploadFileToServer($prefix, $key,PATH_FILES);	
	}
	
	public function uploadFilePersonal($prefix,$key){
		$path = PATH_FILES;
		if($key == 'url_foto'){
			$path = PATH_FILES_IMAGE;	
		}
		
		if($_POST['fileName'] != ''){		
			unlink(PATH_FILES.$_POST['fileName']);			
		}
		return $this->uploadFileToServer($prefix, $key, $path);	
	}
	
	private function uploadFileToServer($prefix,$key,$path){
		
		$name = $_FILES[$key]['name'];
		$name_tmp = $_FILES[$key]['tmp_name'];
		$name = explode('.', $name);
		$nombre = $prefix.rand().".".$name[1];
		@move_uploaded_file($name_tmp, $path . $nombre);
		return $nombre;
	}
	
}