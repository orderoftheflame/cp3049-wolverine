<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
	if (!is_null($_POST['txtUsernameLogin'])){
  	$username = $_POST['txtUsernameLogin'];
  	$password = $_POST['txtPasswordLogin'];
  	
    $user = Person::validateLogin($username, $password);
  }
  if ($user){
	$pr01 = Project::fromDatabasePerson($user->getPersonID());
	if (!is_null($pr01)){
    $pr01_detail = "<p>Title: ".$pr01->getTitle()."</p>";
    $pr01_detail .= "<p>Details: ".$pr01->getDetails()."</p>";
    $pr02 = Project2::fromDatabase($pr01->getProjectID());
  	if (!is_null($pr02)){
      $pr02_detail = "<p>Title: ".$pr02->getTitle()."</p>";
      $pr02_detail .= "<p>Details: ".$pr02->getDetails()."</p>";
      $pr02_detail .= "<p>Aims & Objectives: ".$pr02->getAimsObjectives()."</p>";
      $pr02_detail .= "<p>Client: ".$pr02->getClient()."</p>";
      $pr02_detail .= "<p>Hardware/Software: ".$pr02->getRequirements()."</p>";
      
    }else{
      $pr02_detail = "No PR02 submitted";
    }
  }else{
    $pr01_detail = "No PR01 submitted";
  }}
  
  
  

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

	<h1>Your account - Student</h1> 
  <div class="left half-width bordered padded">
  <h2>Control Panel</h2>
  <a href="submit-project-2.php" class="yellow bordered button max-width">Submit PR02</a><br />
  <a href="upload-interim-report.php" class="yellow bordered button max-width">Upload Interim Report</a><br />
  <a href="#" class="yellow bordered button max-width">Request ethical approval</a><br />
  <a href="student-weekly-feedback.php" class="yellow bordered button max-width">Weekly Meeting Feedback</a><br />
  </div>
  <div class="right half-width bordered padded">
  <h2>Selected Project</h2>
  <p><strong>PR01 <a href="#" onclick="Effect.toggle('pr01_details','slide'); return false;">Show/Hide</a></strong></p>
  <div id="pr01_details" style="display:none;">
  {$pr01_detail}
  </div>
  <p><strong>PR02 <a href="#" onclick="Effect.toggle('pr02_details','slide'); return false;">Show/Hide</a></strong></p>
  <div id="pr02_details" style="display:none;">
  {$pr02_detail}
  </div>
  <p>Status: <strong>Approved</strong></p>
  <p>Supervisor: <strong>Derek Beardsmore</strong> - <a href="#" onclick="$('contactSupervisor').show(); return false;">Send PM</a></p>
  <p>Last supervisor message:</p>
  <p><strong>Please come see me on the 11th to discuss the literary review.</strong></p>
  <p>Reader: <strong>Arline Wilson</strong> - <a href="#" onclick="$('contactReader').show(); return false;">Send PM</a></p>
  <p>Last reader message:</p>
  <p><strong>Good work on the review, please include more references, and ensure they are properly cited.</strong></p>
  </div>
ACC_CONTROLS;
  //Buffer larger content areas like the main page content
  ob_start();

    

  $user = Person::getLoggedInUser();
  if (is_null($user)){
    $rawError = "You are not logged in, please login to view your account";
    include('error.php');
  }else{
   //quick and dirty redirect...
		if ($user->isStaff()){
			header("location: staff-home.php");
		} 
  echo $accountControls;
  }
  
	
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Account";
  //Apply the template
  include("master.php");
?>
