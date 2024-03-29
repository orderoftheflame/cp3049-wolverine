<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
	
$accountControls = <<<ACC_CONTROLS

<div id="contactReader" style="display:none;margin-left:200px;width:300px;height:200px;overflow:auto;" class="absolute bordered padded">
<div id="v_draghandle" class="max-width blue bold" style="cursor:move;text-align:right;"><a href="#" onclick="$('contactReader').fade(); return false;" style="color:#770000;text-decoration:none;" >X</a></div>
  <script type="text/javascript">
    new Draggable('contactReader',{handle:'v_draghandle'});
  </script>
<div id="contactReaderForm"><h2>Contact reader (Arline Wilson)</h2>
<form action="send-pm.php" method="POST" name="frmReader">
<p><label for="txtTitle">Title:</label></p>
<input type="text" name="txtTitle" />
<p><label for="txtMessage">Message:</label></p>
<textarea name="txtMessage"></textarea>
<input type="submit" name="btnSubmit" class="yellow bordered button" value="Send" />
</form>

</div></div>

<div id="contactSupervisor" style="display:none;margin-left:200px;width:300px;height:200px;overflow:auto;" class="absolute bordered padded">
<div id="v_draghandle2" class="max-width blue bold" style="cursor:move;text-align:right;"><a href="#" onclick="$('contactSupervisor').fade(); return false;" style="color:#770000;text-decoration:none;" >X</a></div>
  <script type="text/javascript">
    new Draggable('contactSupervisor',{handle:'v_draghandle2'});
  </script>
<div id="contactSupervisorForm"><h2>Contact Supervisor (Derek Beardsmore)</h2>
<form action="send-pm.php" method="POST" name="frmReader">
<p><label for="txtTitle">Title:</label></p>
<input type="text" name="txtTitle" />
<p><label for="txtMessage">Message:</label></p>
<textarea name="txtMessage"></textarea> 
<input type="submit" name="btnSubmit" class="yellow bordered button" value="Send" />
</form>
</div></div>

	<h1>Your account - Staff</h1> 
  <div class="left half-width bordered padded">
  <h2>Control Panel</h2>
  <a href="weekly-meetings.php?weeknumber=$weeknumber" class="yellow bordered button max-width">Weekly Meetings</a><br />
  <a href="student-groups-overview.php" class="yellow bordered button max-width">View My students</a><br />
  </div>  
  
ACC_CONTROLS;
  //Buffer larger content areas like the main page content
  ob_start();
	
	if (!is_null($_POST['txtUsernameLogin'])){
  	$username = $_POST['txtUsernameLogin'];
  	$password = $_POST['txtPasswordLogin'];
  	
    $user = Person::validateLogin($username, $password);
    if (!is_null($user)){
      echo $accountControls;
    }else{
      echo 'Login failed, please try again.';
    }
  }else{
  $user = Person::getLoggedInUser();
  if (is_null($user)){
    $rawError = "You are not logged in, please login to view your account";
    include('error.php');
  }else{
  echo $accountControls;
  }
  }
	
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Account";
  //Apply the template
  include("master.php");
?>
