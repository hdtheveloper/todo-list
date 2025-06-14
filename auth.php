<?php

include "bootstrap/init.php";


$home_url = site_url();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	 
	$action = $_GET['action'];
	$params = $_POST;
	if($action == 'register'){
		
		$result = register($params);
		if (!$result['success']) {
			showErrors($result['errors']); 
		} else {
			echo "<p style='color: yellow;'>ثبت نام با موفقیت انجام شد. لطفا از طریق فرم زیر وارد شوید.</p> 
			";
		}
	}elseif($action == 'login'){
		
		$result = login($params['email'], $params['password']);
		
		
		if(!$result){
			message("ایمیل یا رمز عبور نامعتبر است!", "danger");
		}else{
			//redirect to home
			redirect(site_url());
		}
	}
	
}

include "views/tpl-auth.php";




