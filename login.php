<?php 
	include_once "header.php"; 
	include_once "db.php";
?>  


<div id="content">
<div class = "inner">
	
	<!--  IF LOGGED IN-->
	<?php
		if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Useremail'])):
	?>
	<h1>You are signed in</h1>
	<br>
	<br>
	<form method = "post" action = "logout.php" name = "logoutbutton" id = "logoutbutton">
		<dl><dt><dd class = "submit">
		<input name = "commit" value = "Sign out" type = "submit">
		</dd></dt></dl>
	</form>
	
	<!-- IF LOGGED OUT -->
	<?php elseif(!empty($_POST['user_email']) && !empty($_POST['user_password'])):
		include_once 'inc/user.php';
		$users = new User($db);
		if($users->accountLogin() == TRUE):
			echo "<meta http-equiv='refresh' content='0;/mel'>";
            exit;
        else:
    ?>

	<h1>Login failed  - try again</h1>
	<form method = "post" action = "login.php" name = "loginform" id = "loginform">
	<dl>
		<dt class="text"><label for="user_email">Email</label></dt>
		<dd><input id="user_email" name="user_email" size="30" value="" type="text"></dd>
		<dt class="text"><label for="user_password">Password</label></dt>
		<dd><input id="user_password" name="user_password" size="30" type="password"></dd>
		<dd class="submit">
		<input name="commit" value="Sign in" type="submit">
		</dd>
	</dl>
	</form>
	<?php 
		endif;
	else:
		//echo $_POST['user_email']; echo " "; echo $_POST['user_password'];
	?>

	<h1>Sign in</h1>
	<form method = "post" action = "login.php" name = "loginform" id = "loginform">
	<dl>
		<dt class="text"><label for="user_email">Email</label></dt>
		<dd><input id="user_email" name="user_email" size="30" value="" type="text"></dd>
		<dt class="text"><label for="user_password">Password</label></dt>
		<dd><input id="user_password" name="user_password" size="30" type="password"></dd>
		<dd class="submit">
		<input name="commit" value="Sign in" type="submit">
		</dd>
	</dl>
	</form>
	
	<?php
	endif;
	?>
</div>
</div>

<?php include_once "footer.php"; ?>