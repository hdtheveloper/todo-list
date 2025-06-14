<?php
defined('BASE_PATH') or die("permision denied");
/**
* Auth Functions
*
*/

function getCurrentUserId(){ 

	return getLoggedInUser()->id ?? 0;
}
function isLoggedIn(){
	return isset($_SESSION['login']) ? true : false; 
	
}

function getLoggedInUser(){
	
		return $_SESSION['login'] ?? true ;
}
function logOut(){
	
		unset($_SESSION['login']);
}
function register($userData) {
    global $pdo;

    $userName = trim($userData['username'] ?? '');
    $email = trim($userData['email'] ?? '');
    $password = $userData['password'] ?? '';

    $errors = [];

    // 1. بررسی خالی نبودن فیلدها
    if (empty($userName)) {
        $errors[] = "نام کاربری نمی‌تواند خالی باشد.";
    }

    if (empty($email)) {
        $errors[] = "ایمیل نمی‌تواند خالی باشد.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "فرمت ایمیل معتبر نیست.";
    }

    if (empty($password)) {
        $errors[] = "رمز عبور نمی‌تواند خالی باشد.";
    } elseif (strlen($password) < 6) {
        $errors[] = "رمز عبور باید حداقل ۶ کاراکتر باشد.";
    }

    // 2. بررسی وجود نام کاربری یا ایمیل در دیتابیس
    $sql = "SELECT COUNT(*) FROM users WHERE name = :name OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $userName, 'email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "نام کاربری یا ایمیل قبلاً ثبت شده است.";
    }

    // 3. اگر اروری وجود داشته باشد، برگردان
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    // 4. هش کردن رمز عبور قبل از ذخیره
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 5. ذخیره در دیتابیس
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $userName,
        'email' => $email,
        'pass' => $hashedPassword
    ]);

    return ['success' => $stmt->rowCount() > 0];
}


function getUserByEmail($email){
	
	global $pdo; 

	
	$sql = "select * from users where email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':email' => $email] );
	$records = $stmt->fetchAll(PDO::FETCH_OBJ);
	return $records[0] ?? null; 

}

function login($email, $pass){
	
	$user = getUserByEmail($email);
	if(is_null($user)){
		return false;
	}
	
	# check the password
	
	if(password_verify($pass, $user->password )){
		# login is successfull
		
		$_SESSION['login'] = $user;
		
		return true;
	}
	return false;
}


