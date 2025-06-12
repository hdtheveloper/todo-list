<?php


include "bootstrap/init.php";

if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
	$deletedRows = deletFolder($_GET['delete_folder']);
	//echo "$deletedRows folders successfully deleted!";
}

if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
	$deletedRows = deleteTask($_GET['delete_task']);
	//echo "$deletedRows tasks successfully deleted!";
}

$folders = getFolders();

$tasks = getTasks();





include "views/tpl-index.php";


 