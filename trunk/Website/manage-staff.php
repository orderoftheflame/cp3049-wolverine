<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();
  
	if (!is_null($user)){
		if (!$user->isAdmin()){
			$rawError = "You do not have permission to access this page";
			include('error.php');
		}else{
			if (!is_null($_POST['txtStaffNumber'])){
				$personID = $_POST['txtStaffNumber'];
				$forename = $_POST['txtForename'];
				$surname = $_POST['txtSurname'];
				$password = $_POST['txtPassword'];
				$email = $_POST['txtEmail'];
				$staff = Staff::withParameters($personID, $forename, $surname, $password, $email);
				$admin = is_null($_POST['chkAdmin']) ? 'false' : 'true';
				$moduleLeader = is_null($_POST['chkModuleLeader']) ? 'false' : 'true';
				$staff->setAdmin($admin);
				$staff->setModuleLeader($moduleLeader);
				$staff->register(false);
				echo 'Staff member saved';
			}
		}
	}else{
		$rawError = "You do not have permission to access this page";
		include('error.php');
	}

	

?>
<h1>Create staff</h1>
<div class="bordered half-width padded right" id="divLogin">
<p><span class="left"><h2>Current Staff List</h2></span></p>
<?php include('controls/ctrl.staff.php'); ?>
</div>
<form action="manage-staff.php" method="post" name="signup">
<div class="bordered half-width padded left" id="divRegister">
<p><span class="left"><h2>Register</h2></span></p>
<p>Please enter your details below to sign up</p>
<p><span class="left"><label for="txtStaffNumber">Staff Number:</label> </span><span class="right"><input type="text" name="txtStaffNumber" maxlength="120" /></span></p>
<p><span class="left"><label for="txtPassword">Password:</label> </span><span class="right"><input type="password" name="txtPassword" maxlength="100" /></span></p>
<p><span class="left"><label for="txtForename">Forename:</label> </span><span class="right"><input type="text" name="txtForename" maxlength="120" /></span></p>
<p><span class="left"><label for="txtSurname">Surname:</label> </span><span class="right"><input type="text" name="txtSurname" maxlength="120" /></span></p>
<p><span class="left"><label for="txtEmail">Email:</label> </span><span class="right"><input type="text" name="txtEmail" maxlength="50" /></span></p>
<p>
<span class="right clearer"><input type="checkbox" name="chkAdmin" id="chkAdmin" /> Admin 
<input type="checkbox" name="chkModuleLeader" id="chkModuleLeader" /> Module Leader</span>
</p>
<p><span class="right"><input type="submit" name="btnSignUp" value="Create Staff" class="yellow bordered margin" /></span></p>
<p id="txtUserResult"></p>
</div>
</form>




<?php

  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Create staff";
  //Apply the template
  include("master.php");
?>
