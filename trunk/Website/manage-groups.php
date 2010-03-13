<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();

	if (!is_null($user)){
		echo '<h1>Manage student groups</h1>';
		if (!$user->isAdmin()){
			$rawError = "You do not have permission to access this page";
			include('error.php');
		}else{	//Manage any postbacks
			if (!is_null($_POST['txtGroupName'])){
				$feedback = Utility::checkPostData(
				array('Group name'=>$_POST['txtGroupName'],
				'Details'=>$_POST['txtGroupDetails'])
				);
				if (count($feedback) > 0){
					echo '<div class="error padded margin">
					<p>Error</p>
					<ul>';
					foreach($feedback as $message){
						echo '<li class="bullets">'.$message.' is required</li>';
					}
					echo '</ul></div>';
				}else{
				$group = StudentGroup::withParameters($_POST['txtGroupName'],$_POST['txtGroupDetails'],$_POST['ddlDays'],$_POST['ddlHours'].':'.$_POST['ddlMinutes']);
					$group->save();
					
					echo '<div class="error padded margin"><p>Group ['.$group->getTitle().'] saved.</p></div>';
				}
			}
			if(!is_null($_POST['btnRemoveGroup'])){
				StudentGroup::delete($_POST['ddlGroups']);
				echo '<div class="error padded margin"><p>Group removed.</p></div>';
			}
		}
	}else{
		$rawError = "You do not have permission to access this page";
		include('error.php');
	}
	
	?>

<div class="bordered half-width padded right" id="divLogin">
<p><span class="left"><h2>Current group List</h2></span></p>
<form action="manage-groups.php" method="POST" name="frmManageGroups">
<select name="ddlGroups" id="ddlGroups" class="max-width" size="10" onchange="callService('services/group-details.php',this.value,'loadedDetails');">
<?php
$groups = StudentGroupCollection::fromDatabase();
foreach($groups->getGroups() as $group){
$groupText = $group->getTitle().' - '.substr($group->getDay(),0,3).' at '.substr($group->getTime(),0,5);
	echo Utility::optionBind($group->getGroupID(),$groupText);
}
 ?>
</select>
<input type="submit" onclick="return confirm('Are you sure? Any students in the group will become unassigned')" class="yellow bordered margin button" name="btnRemoveGroup" id="btnRemoveGroup" value="Remove Group" />
</form>
<div id="groupDetails" class="clearer">
<h2>Selected group details:</h2>
<div id="loadedDetails">Select a group</div>
</div>
</div>

<form action="manage-groups.php" method="post" name="creategroup">
<div class="bordered half-width padded left" id="divRegister">
<p><span class="left"><h2>Create group</h2></span></p>
<p>Please enter group details below</p>
<p><span class="left"><label for="txtGroupName">Group name:</label> </span><span class="right"><input type="text" name="txtGroupName" maxlength="64" /></span></p>
<p><span class="left"><label for="txtGroupDetails">Details:</label> </span><span class="right"><textarea name="txtGroupDetails" maxlength="512" ></textarea></span></p>
<p><span class="left"><label for="txtMeetingDay">Meeting day:</label> </span>
<span class="right">
<select name="ddlDays" id="ddlDays" class="max-width">
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
</select>
</span></p>
<p><span class="left"><label for="txtMeetingTime">Meeting time:</label> </span><span class="right">
<select name="ddlHours" id="ddlHours">
<option value="7">7</option>
<option value="8">8</option>
<option value="9" selected="">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
</select>
<select name="ddlMinutes" id="ddlMinutes">
<option value="00">00</option>
<option value="15">15</option>
<option value="30">30</option>
<option value="45">45</option>
</select>
</span></p>
<p><span class="right"><input type="submit" name="btnCreateGroup" value="Create Group" class="yellow bordered margin button" /></span></p>
<p id="txtUserResult"></p>
</div>
</form>




<?php

  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Create student groups";
  //Apply the template
  include("master.php");
?>
