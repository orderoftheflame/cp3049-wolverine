<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();
  
	if (!is_null($user)){
		if (!$user->isAdmin()){
    $rawError = "You do not have permission to access this page";
    include('error.php');
    }
  }

	

?>
<h1>Create staff</h1>
<div class="bordered half-width padded right" id="divLogin">
<p><span class="left"><h2>Current Staff List</h2></span></p>
<form action="manage-staff.php" method="POST" name="frmManageStaff">
<select name="ddlSupervisors" id="ddlSupervisors" class="max-width" size="10">
<option>Derek Beardsmore</option>
<option>Arline Wilson</option>
<option>Matthew Burley</option>
</select>
<a href="#" class="yellow bordered padded button">Remove Staff</a>
</form>
</div>
<form action="register.php" method="post" name="signup">
<div class="bordered half-width padded right" id="divRegister">
<p><span class="left"><h2>Register</h2></span></p>
<p>Please enter your details below to sign up</p>
<p><span class="left"><label for="txtStudentNumber">Staff Number:</label> </span><span class="right"><input type="text" name="txtStudentNumber" maxlength="120" /></span></p>
<p><span class="left"><label for="txtPassword">Password:</label> </span><span class="right"><input type="password" name="txtPassword" maxlength="100" /></span></p>
<p><span class="left"><label for="txtForename">Forename:</label> </span><span class="right"><input type="text" name="txtForename" maxlength="120" /></span></p>
<p><span class="left"><label for="txtSurname">Surname:</label> </span><span class="right"><input type="text" name="txtSurname" maxlength="120" /></span></p>
<p><span class="left"><label for="txtEmail">Email:</label> </span><span class="right"><input type="text" name="txtEmail" maxlength="50" /></span></p>
<p><span class="right"><input type="submit" name="btnSignUp" value="Create User" class="yellow bordered margin button" /></span></p>
<p id="txtUserResult"></p>
</div>
</form>




<?php

  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Login/Register";
  //Apply the template
  include("master.php");
?>
