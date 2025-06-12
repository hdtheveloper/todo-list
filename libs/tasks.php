<?php


/*if(!defined('BASE_PATH')){
	echo "permision denied";
	die();
}
*/

defined('BASE_PATH') or die("permision denied");

/**
* Folder Functions
* 
*/


function addFolder($folder_name){
	
	global $pdo;
	$currentUserId = getCurrentUserId();
	$sql = "INSERT INTO `folders` (name, user_id) VALUES(:folder_name, :user_id)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['folder_name' =>$folder_name , 'user_id'=>$currentUserId ]);
	
	
    if ($stmt->rowCount()) {
        $folderId = $pdo->lastInsertId(); // <== گرفتن id فولدر جدید
        return json_encode([
            'status' => 1,
            'id' => $folderId,
            'name' => $folder_name
        ]);
    } else {
        return json_encode([
            'status' => 0,
            'message' => 'خطا در افزودن دسته بندی'
        ]);
    }
	
	
}

function deletFolder($folder_id){ 
	
	global $pdo;
	$currentUserId = getCurrentUserId();
	$sql = "delete from folders where id = $folder_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->rowCount();
	
}

function getFolders(){
	global $pdo;
	$currentUserId = getCurrentUserId();
	$sql = "select * from folders where user_id = $currentUserId";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$records = $stmt->fetchAll(PDO::FETCH_OBJ);
	return $records;
}

/**
* Task Functions
*
*/

function getTasks(){
	
	global $pdo;
	$currentUserId = getCurrentUserId();
	$folder = $_GET['folder_id'] ?? null;
	$folderCondition = '';
	if(isset($folder) && is_numeric($folder)){
		$folderCondition = "and folder_id=$folder";
	}
	$sql = "select * from tasks where user_id = $currentUserId $folderCondition";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$records = $stmt->fetchAll(PDO::FETCH_OBJ);
	return $records;
}

//function deletTask($task_id){ 
	
	//global $pdo;
	
	//$sql = "delete from tasks where id = $task_id";
	//$stmt = $pdo->prepare($sql);
	//$stmt->execute();
	//return $stmt->rowCount();
	
//}

function addTask($taskTitle, $folderId){
	
	global $pdo;
	$currentUserId = getCurrentUserId();
	$sql = "INSERT INTO `tasks` (title, user_id, folder_id) VALUES(:title, :user_id, :folder_id )";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['title' =>$taskTitle , 'user_id'=>$currentUserId, 'folder_id'=>$folderId ]);
	return $stmt->rowCount();
	
}

function doneSwitch($taskId, $status ){


        // بررسی معتبر بودن ورودی‌ها
        if (is_numeric($taskId) && ($status == 0 || $status == 1)) {
			global $pdo;
	$currentUserId = getCurrentUserId();
			
            $stmt = $pdo->prepare("UPDATE tasks SET is_done = ? WHERE user_id = ? AND id = ?");
            $success = $stmt->execute([$status, $currentUserId, $taskId]);

            if ($success) {
                echo json_encode(['status' => 1, 'message' => 'وضعیت با موفقیت بروزرسانی شد']);
            } else {
                echo json_encode(['status' => 0, 'message' => 'خطا در بروزرسانی']);
            }
        } else {
            echo json_encode(['status' => 0, 'message' => 'داده نامعتبر']);
        }
        exit;
		

}

function deleteTask($taskId){
	
	global $pdo;
	
	    if (is_numeric($taskId)) {
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
        $success = $stmt->execute([$taskId]);

        if ($success) {
            echo json_encode(['status' => 1, 'message' => 'تسک حذف شد']);
        } else {
            echo json_encode(['status' => 0, 'message' => 'خطا در حذف تسک']);
        }
    } else {
        echo json_encode(['status' => 0, 'message' => 'آیدی نامعتبر']);
    }
    exit;
}