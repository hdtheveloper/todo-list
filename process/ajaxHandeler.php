<?php


include_once "../bootstrap/init.php";


if (!isAjaxRequest()){
	diePage("درخواست نامعتبر است.");
}
if (!isset($_POST['action']) || empty($_POST['action'])){
	diePage("مسیر ارسال نامعتبر است."); 
}

switch($_POST['action']){
	case 'addFolder' : 
	
	if(!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3){
		echo "نام فولدر باید بزرگتر از 3 حرف باشد.";
		die();
	}
		echo addFolder($_POST['folderName']);
	
	break;
	case 'addTask' : 
	
	$folderId = $_POST['folderId'];
	$taskTitle = $_POST['taskTitle'];
	
	
	if(!isset($folderId) || empty($folderId)){
		echo "ابتدا دسته ی مورد نظز را انتخاب کنید.";
		die();
	}
	
	if(!isset($taskTitle) || strlen($taskTitle) < 3 ){
		echo "عنوان تسک باید بزرگتر از 2 حرف باشد";
		die();
	}
	
	echo addTask($taskTitle, $folderId);
		
	break;
	case 'doneSwitch' : 
		
		$taskId = $_POST['taskId'] ?? null;
        $status = $_POST['status'] ?? 0;
		
		echo doneSwitch($taskId, $status );
		
	break;
	case 'deleteTask' : 
		
		$taskId = $_POST['taskId'] ?? null;
		
		echo deleteTask($taskId);
		
	break;
	case 'searchTasks' : 
		
		echo searchTasks();
		
	break;

	default :
		diePage("مسیر ارسال نامعتبر است.");
}

