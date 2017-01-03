<?php
require_once 'business.php';
require_once 'controller_utils.php';




function index(&$model)
{	
	return 'index_view';
}


function logout(&$model)
{	
	$_SESSION['user_id'] = null;
	return 'redirect:photos';
}


function contact(&$model)
{	
	return 'contact_view';
}


function quiz(&$model)
{	
	return 'quiz_view';
}


function history(&$model)
{	
	return 'history_view';
}


function login(&$model)
{
	$user =
	[
		'nickname' => null,
		 'password' => null		 
	];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	{
		if (!empty($_POST['nickname']) &&
		!empty($_POST['password'])) {
						
			$user = [
		  	            'nickname' => $_POST['nickname'],
				       'password' => $_POST['password']
					   ];	
		       
			
			if (check_user($user, $_SESSION['user_id']));
			{						
						return 'redirect:photos';				
			 }
		}
	}
	
	$model['user'] = $user;	
	return 'login_view';
}


function register(&$model)
{
	$user =
	[
		'nickname' => null,
		 'password' => null,
		 'repeat_password' => null,
		 '_id' => null ,
		 'error' => null
	];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!empty($_POST['nickname']) &&
		    !empty($_POST['password']) && 
			!empty($_POST['repeat_password'])) 
		{			
			$id = isset($_POST['id']) ? $_POST['id'] : null;
			$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$user = [
		  	            'nickname' => $_POST['nickname'],
				       'password' => $hash
					   ];			
		   
		    if($_POST['password'] != $_POST['repeat_password'])
			{
				$user =[		
						'nickname' => null,				
	 					'password' => null,
	 					'repeat_password' => null,
	 					'_id' => null,
						 'error' => null												
						];
						$user['error'] .= 'Hasła nie pasują ';
				$model['user'] = $user;				
				return 'register_view';	
				
			}
			if(check_user_nickname($user))
			{
				$user =[		
						'nickname' => null,				
	 					'password' => null,
	 					'repeat_password' => null,
	 					'_id' => null,
						 'error' => null
						];
						$user['error'] .= 'Login zajęty';
				$model['user'] = $user;							
				return 'register_view';				
			}
			if (save_user($id, $user));
			{			

				return 'redirect:photos';
				
			 }
		}
	}
	elseif (!empty($_GET['id'])) {
		$user = get_user($_GET['id']);
	}
	$model['user'] = $user;	
	return 'register_view';	

	
}


function photos(&$model)
{
	$photos = get_photos();
	$users = get_users();		
	$model['users'] = $users;
	$model['photos'] = $photos;	
	
	if(isset($_SESSION['select_photos'])){
	$model['select_photos'] = $_SESSION['select_photos'];
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (!empty($_POST['select_photo'])) 
			{
				update_photo_session($_POST['select_photo'], $_SESSION['select_photos']);			
				return 'photos_view';
			}
	}	
	return 'photos_view';
}


function photo_saved(&$model)
{
	
	if(isset($_SESSION['select_photos'])){
	$model['select_photos'] = $_SESSION['select_photos'];
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (!empty($_POST['select_photo'])) 
			{
				delete_photo_session($_POST['select_photo'], $_SESSION['select_photos']);
				
				return 'photo_saved_view';
			}
	}
	return 'photo_saved_view';
}


function photo(&$model)
{
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
		if ($photo = get_photo($id)) {
			$model['photo'] = $photo;
			return 'photo_view';
		}
	}
	
	http_response_code(404);
	exit;
}


function edit(&$model)
{
	$photo = [
			        'name' => null,
			        'name_wather' => null,
			        'author' => null,
			        'filename' => null,
			        'filename_mark' => null,
			        'filename_thumb' => null,
			        '_id' => null,
					'error' => null,
					'email' => null
			    ];
	 $model['photo'] = $photo;	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!empty($_POST['name']) &&
		    !empty($_POST['name_wather'])) 
		{
			$id = isset($_POST['id']) ? $_POST['id'] : null;
			
			$photo = [
		  	            'name' => $_POST['name'],
				       'name_wather' => $_POST['name_wather'],
					   'author' => $_POST['author'],
					   'filename' => $_FILES["fileToUpload"]["name"],
						'email' => $_POST['email']];
		    $GOOD = TRUE;
			save_image($_FILES["fileToUpload"]["tmp_name"],
			 $_FILES["fileToUpload"]["name"],$photo, $GOOD);			
			if(!$GOOD)
	       {		
				clearPhoto($photo);							
				$model['photo'] = $photo;
				
				return 'edit_view';
			}
			if (save_photo($id, $photo));
			{
				return 'redirect:photos';
			}
		}
	}
	elseif (!empty($_GET['id'])) {
		$photo = get_photo($_GET['id']);
	}
	$model['photo'] = $photo;
	return 'edit_view';
}


function delete(&$model)
{
	
	if (!empty($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			delete_photo($id);
			return 'redirect:photos';
			
		}
		else {
			if ($photo = get_photo($id)) {
				$model['photo'] = $photo;
				return 'delete_view';
			}
		}
	}
	
	
	http_response_code(404);
	exit;
}

// function cart(&$model)
// {
// 	$model['cart'] = get_cart();
// 	return 'fragments/cart_view';
// }

// function add_to_cart()
// {
// 	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
// 		$id = $_POST['id'];
// 		$photo = get_photo($id);
		
// 		$cart = &get_cart();
// 		$amount = isset($cart[$id]) ? $cart[$id]['amount'] + 1 : 1;
		
// 		$cart[$id] = ['name' => $photo['name'], 'amount' => $amount];
		
// 		return 'redirect:' . $_SERVER['HTTP_REFERER'];
// 	}
// }

function clear_cart()
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$_SESSION['cart'] = [];
		return 'redirect:' . $_SERVER['HTTP_REFERER'];
	}
}
