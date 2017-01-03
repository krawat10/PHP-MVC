<?php


function get_db()
{
	$mongo = new MongoClient(
	        "mongodb://localhost:27017/",
	        [
	            'username' => 'wai_web',
	            'password' => 'w@i_w3b',
	            'db' => 'wai',
	        ]);
	
	$db = $mongo->wai;
	
	return $db;
}


function DeleteImages() {
	$db = get_db();
$images = $db->photos->find(); 

 foreach($images as $image) {
 $db->photos->remove($image);
 }
 }


function get_photos()
{
	$db = get_db();
	return $db->photos->find();
}


function get_users()
{
	$db = get_db();
	return $db->users->find();
}


function check_user_nickname($cat)
{
	$db = get_db();
	$user = $db->users->findOne(['nickname' => $cat['nickname']]);
	return (isset($user));	
}


function get_photos_by_category($cat)
{
	$db = get_db();
	$photos = $db->photos->find(['cat' => $cat]);
	return $photos;
}


function update_photo_session($post, &$array)
{
	foreach($post as $select)
				{			
					if(isset($array))
					{
						if(!in_array(get_photo($select), $array))
						{
							$selected_photos[] = get_photo($select);
						}
					}
					else{
						$selected_photos[] = get_photo($select);
					}								
				}
				if(!isset($array))
				{
					$array = $selected_photos;
				}
				elseif(!isset($selected_photos))
				{
					return;
				}
				else{
					$array = array_merge($array, $selected_photos);
				}
}


function delete_photo_session($post, &$arrays)
{	
	$array = $arrays;
	$photos = get_photos();
	foreach($post as $select)
				{		
				
				for($i = $photos->count() ; $i >= 0; $i--)
				{
					if(isset($array[$i])){
						if($array[$i]['_id'] == $select)
					{						
						unset($array[$i]);
						array_values($array);						
					}					
					}					
				}	
				}
	$arrays = $array;				
}


function check_user($cat, &$session)
{
	$db = get_db();
	$user = $db->users->findOne(['nickname' => $cat['nickname']]);	
	if($user != null && password_verify($cat['password'], $user['password']))
	{		
		$session = $user['_id'];
		return true;
	}
	else
	{			
		return false;
	}	
}


function get_photo($id)
{
	$db = get_db();
	return $db->photos->findOne(['_id' => new MongoId($id)]);
}


function get_user($id)
{
	$db = get_db();
	return $db->users->findOne(['_id' => new MongoId($id)]);
}


function clearPhoto(&$photo)
{
$newphoto = [         
					'name' => $photo['name'],
			        'name_wather' => $photo['name_wather'],
			        'author' => $photo['author'],   				   
					'email' => $photo['email'],
					'error' => $photo['error'],
					'filename' => null,
			        'filename_mark' => null,
			        'filename_thumb' => null,
			        '_id' => null
					];

$photo = $newphoto;
}


function save_image($file, $realname, & $info, & $CONDITION)
{
	$CONDITION = TRUE;
	$target_dir = "images/";
	$target_file = $target_dir . basename($realname);
	$check = getimagesize($file);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$error = null;
	if($imageFileType != "jpg" && $imageFileType != "png") {
		$error = $error . " Sorry, only JPG & PNG files are allowed.";
		$uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 1024*1024) {
		$error = $error .  " Sorry, your file is too large.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$info['error'] = $error .  " Sorry, your file was not uploaded.";
		$CONDITION = FALSE;
		return false;
	}	
	$extension_pos = strrpos($realname, '.');
	
	    $thumb = substr($realname, 0, $extension_pos) . '_thumb' . substr($realname, $extension_pos);
	$info['filename_thumb'] = $thumb;
	
	resize_image($file, $realname, $imageFileType, $thumb);
	
	
	$extension_pos = strrpos($realname, '.');
	
	    $mark = substr($realname, 0, $extension_pos) . '_mark' . substr($realname, $extension_pos);
	$info['filename_mark'] = $mark;
	watermark_image($file, $realname, $imageFileType, $mark, $info['name_wather']);
	
	if (move_uploaded_file($file, $target_file)) {
		
		return true;
	}
	else {
		return false;
	}
}


function watermark_image($filename, $realname, $type, $mark, $string)
 {
	list($orig_width, $orig_height) = getimagesize($filename);
	
	if($type == "jpg") 
	{
		$image = imagecreatefromjpeg($filename);
	}
	elseif($type == "png")
	{
		$image = imagecreatefrompng($filename);
	}
	
	imagestring($image , 5 , $orig_width/2 , $orig_height/2
	   , $string , 25 );
	
	$target_dir = "images/";
	$target_file = $target_dir . basename($mark);
	imagejpeg($image, $target_file);
	imagedestroy($image);
}


function resize_image($filename, $realname, $type, $thumb)
{
	list($orig_width, $orig_height) = getimagesize($filename);
	$height = 200;
	$width = 125;
	$image_p = imagecreatetruecolor($width, $height);
	
	if($type == "jpg") 
	{
		$image = imagecreatefromjpeg($filename);
	}
	elseif($type == "png")
	{
		$image = imagecreatefrompng($filename);
	}
	
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, 
	                                     $width, $height, $orig_width, $orig_height);
	
	$target_dir = "images/";
	$target_file = $target_dir . basename($thumb);
	imagejpeg($image_p, $target_file);
	imagedestroy($image_p);
	imagedestroy($image);
}


function save_photo($id, $photo)
{
	$db = get_db();
	
	if ($id == null) {
		$db->photos->insert($photo);
	}
	else {
		$db->photos->update(['_id' => new MongoId($id)], $photo);
	}
	
	return true;
}


function save_user($id, $user)
{
	$db = get_db();
	
	if ($id == null) {
		$db->users->insert($user);
	}
	else {
		$db->users->update(['_id' => new MongoId($id)], $user);
	}	
	return true;
}


function delete_photo($id)
{
	$db = get_db();
	$db->photos->remove(['_id' => new MongoId($id)]);
}

