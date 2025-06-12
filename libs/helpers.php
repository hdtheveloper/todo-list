<?php

defined('BASE_PATH') or die("permision denied");

function getCurrentUrl(){
	return 1;
}


function isAjaxRequest(){
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest"){
		return true;
	}
	return false;
}


function diePage($msg){
	
	echo "<div style='margin: 50px auto;
  padding: 30px;
  width: 550px;
  background: #fdcbac;
  border-radius: 20px; 
'>$msg</div>";
	die();
	
}
function dd($var){
	echo "<pre style='color: #685f5f;background: white;padding: 50px;border-left: 3px solid rebeccapurple;'>";
	var_dump($var);
	echo "</pre>";
	die();
}


function site_url($uri = ''){
	BASE_URL . $uri;
}