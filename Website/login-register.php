<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();
  
	if (!is_null($user)){
		if (!is_null($_GET['action'])){
			$action = $_GET['action'];
			if ($action == "logout"){
				$user->logout();
				echo '<h1>See you later!</h1><p>You are now logged out, come back soon!</p>';
			}
		}else{
			echo '<h1>Hello '.$user->getForename().'!</h1><p>You are already logged in... trying to get to <a href="my-account.php">your account</a>?</p>';
		}

	
	}else{
?>
<h1>Sign up or sign in!</h1>
<form action="register.php" method="post" name="signup">
<div class="bordered half-width padded left" id="divRegister">
<p><span class="left"><h2>Register</h2></span></p>
<p>Please enter your details below to sign up</p>
<p><span class="left"><label for="txtStudentNumber">Student Number:</label> </span><span class="right"><input type="text" name="txtStudentNumber" maxlength="120" /></span></p>
<p><span class="left"><label for="txtPassword">Password:</label> </span><span class="right"><input type="password" name="txtPassword" maxlength="100" /></span></p>
<p><span class="left"><label for="txtForename">Forename:</label> </span><span class="right"><input type="text" name="txtForename" maxlength="120" /></span></p>
<p><span class="left"><label for="txtSurname">Surname:</label> </span><span class="right"><input type="text" name="txtSurname" maxlength="120" /></span></p>
<p><span class="left"><label for="txtEmail">Email:</label> </span><span class="right"><input type="text" name="txtEmail" maxlength="50" /></span></p>
<p><span class="right"><input type="submit" name="btnSignUp" value="Sign me up!" class="yellow bordered margin" /></span></p>
<p id="txtUserResult"></p>
</div>
</form>
<form action="my-account.php" method="post" name="login">
<div class="bordered half-width padded right" id="divLogin">
<p><span class="left"><h2>Sign in</h2></span></p>
<p><span class="left"><label for="txtUsernameLogin">Username:</label> </span><span class="right"><input type="text" name="txtUsernameLogin"/></span></p>
<p><span class="left"><label for="txtPasswordLogin">Password:</label> </span><span class="right"><input type="password" name="txtPasswordLogin"/></span></p>
<p><span class="right"><input type="submit" name="btnLogin" value="Login!" class="yellow bordered margin" /></span></p>
</div>
</form>

<?php
}
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Login/Register";
  //Apply the template
  include("master.php");
?>
