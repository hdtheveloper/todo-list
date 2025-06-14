<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo SITE_TITLE; ?></title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
     <link rel="stylesheet" href="<?= site_url('assets/css/auth.css'); ?>">
	  <ul class="lightrope">
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
	</ul>
			<?php if (!empty($errors)): ?>
			<div style="color: red;">
				<ul>
					<?php foreach ($errors as $err): ?>
						<li class="alert alert-warning" ><?= htmlspecialchars($err) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">ورود</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">ثبت نام</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<form action="<?= site_url('auth.php?action=login'); ?>" method="POST">
					<div class="group">
						<label for="emailemail" class="label">آدرس ایمیل</label>
						<input id="email" name="email" type="email" class="input">
					</div>
					<div class="group">
						<label for="password" class="label">رمز عبور</label>
						<input id="password" type="password" name="password" class="input" data-type="password">
					</div>

					<div class="group">
						<input type="submit" class="button" value="ورود">
					</div>

				</form>
			</div>
			<div class="sign-up-htm">
				<form action="<?= site_url('auth.php?action=register'); ?>" method="POST">
					<div class="group">
						<label for="username" class="label">نام کاربری</label>
						<input id="username" type="text" name="username" class="input">
					</div>
					<div class="group">
						<label for="passwordpassword" class="label">رمز عبور</label>
						<input id="password" type="password" name="password" class="input" data-type="password">
					</div>
	
					<div class="group">
						<label for="email" class="label">آدرس ایمیل</label>
						<input id="email" type="email" name="email" class="input">
					</div>
					<div class="group">
						<input type="submit" class="button" value="ثبت نام">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  


</body>

</html>
<!-- partial -->
  
</body>
</html>
