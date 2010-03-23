<?php include('config/init.php'); ?>
<?php
	$currentWeekNumber = $_GET['weeknumber'];
	
	if ($currentWeekNumber < 1 )
	{
		$currentWeekNumber = 1;
	}
	if ($currentWeekNumber > $weeknumber )
	{
		$currentWeekNumber = $weeknumber; 
	}
	
	$user = Person::getLoggedInUser();
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
?>
	<?php
	function helpIcon($helpText, $helpLink)
	{
		$text = $helpText;
		$link = $helpLink;
		
		$helpIcon = "<a style=\"cursor:help;\" href=\"".$link."\"><img src=\"img/qmark.png\" width=\"12px\" height=\"12px\" title=\"".$text."\"></a>";
		
		return $helpIcon;
	}
	?>
	<script language="JavaScript">
	var timeStep = 50; //time in milliseconds to wait before each step
	var stepAmount = 100; //the amount to step each step (px)
	
	function toggleWindow(windowElementName, min, max)
	{
		var windowElement = document.getElementById(windowElementName);
		if (windowElement.style.height == "")
		{
			windowElement.style.height = min+"px"
		}
		if (windowElement.style.height == min+"px")
		{
			expandWindow(windowElementName, min, max);
		}	
		else
		{
			hideContent(windowElementName);
			shrinkWindow(windowElementName, max, min);
		}
	}
	
	function hideContent(contentID)
	{
		var windowElement = document.getElementById(contentID);
		windowElement.style.visibility="hidden"
	}
	
	function showContent(contentID)
	{
		var windowElement = document.getElementById(contentID);
		windowElement.style.visibility="visible"
	}
	
	function expandWindow(windowElementName, current, max)
	{
		var windowElement = document.getElementById(windowElementName);
		current = current+stepAmount;
		if (current > max)
		{
			current = max;
		
		}
		//alert(current);
		windowElement.style.height = current+"px";
		if (current < max)
		{
			setTimeout('expandWindow("'+windowElementName+'",'+current+','+max+')', timeStep);	
		}
		else
		{
			showContent(windowElementName);
		}
	}
	function shrinkWindow(windowElementName, current, min)
	{
		var windowElement = document.getElementById(windowElementName);
		current = current - stepAmount;
		if (current < min)
		{
			current = min;
		}
		windowElement.style.height = current+"px";
		if (current > min)
		{
			setTimeout('shrinkWindow("'+windowElementName+'",'+current+','+min+')', timeStep);	
		}
	}
	
	var xmlhttp;
	function loadScriptPage(url)
	{
		url = url+"&weeknumber=<?=$currentWeekNumber?>";
		xmlhttp=null;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{// IE 5 and IE 6 (this sohws the activeX warning message
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		if (xmlhttp!=null)
		{
			xmlhttp.open("GET",url,true);
			//alert("xmlhttp.open(\"GET\","+url+",true)") 
			xmlhttp.send(null);
		}
		else
		{
			alert("Your browser does not support XMLHTTP.");
		}
	}

	function toggleCheckBox(featuredCheckBox, studentID, mode)
	{
		var featuredFlag = 0 
		
		if (featuredCheckBox == true)
		{
			featuredFlag = 1
		}
		else
		{
			featuredFlag = 0
		} 
		loadScriptPage("services/weekleyMeetingScript.php?id="+studentID+"&mode="+mode+"&flag="+featuredFlag);
	}

	</script>
	<?php
	//check if next a previous are allowed
	if ($currentWeekNumber > 1)
	{
	?>
		<div style="float:left"><a href="<?=$_SERVER['PHP_SELF']?>?weeknumber=<?=$currentWeekNumber-1?>">< Previous Week</a></div>
	<?php
	}
	 
	if ($currentWeekNumber < $weeknumber)
	{
	?>
		<div style="float:right"><a href="<?=$_SERVER['PHP_SELF']?>?weeknumber=<?=$currentWeekNumber+1?>">Next Week ></a></div>
	<?php
	}
	?>
	<div style="text-align:center;"><h2>Week <?=$currentWeekNumber?></h2></div> 
	<br> 
	<!--put this in loop calling sutents for this supervisor-->
	<?php
		
		if ($user->isStaff())
		{
			$groups = StudentGroupCollection::fromDatabaseStaff($user->getPersonID());
			foreach($groups->getGroups() as $group){
				echo ("<H2>".$group->getTitle()." - ".$group->getDay()." at ".$group->getTime()."</H2>");
				foreach($group->getStudents() as $student){
				//grab feedback from database 
				//returns an empty object if none if found
		
				$feedback = Feedback::fromDatabaseStudentWeek($student->getPersonID(), $currentWeekNumber); 	 		
	?>
				<div class="windowContainer"> 
					<div class="StudentWindowTitle">
						<div style="float:right; font-size:140%; font-weight:normal; padding-right:5px; cursor:pointer;" onclick="toggleWindow('Student<?=$student->getPersonID()?>',2,250);">[Show Feedback]</div>
						<div class="StudentName"><?=$student->getPersonID()?> - <?=$student->getForename()?> <?=$student->getSurname()?></div>
						<table>
							<tr>
								<th style="text-align:center; width:120px;">
									Attended <?=helpIcon("Did the student attend the meeting?", "#")?>
								</th> 
								<th style="text-align:center; width:120px;">
									Journal Signed <?=helpIcon("Was the students project journal seen and signed?", "#")?>
								</th> 
								<th style="text-align:center; width:120px;">
									On Target <?=helpIcon("Do you feel the Student is on target?", "#")?>
								</th>
							</tr>
							<tr>
								<td style="text-align:center;"> 
									<input type="checkbox" <?php if ($currentWeekNumber != $weeknumber) echo("disabled");?> name="attendedStudent<?=$student->getPersonID()?>" onchange="toggleCheckBox(this.checked, '<?=$student->getPersonID()?>', 'attended')" <?php
									if ($feedback->getAttended() == 1) 
									{
										echo("CHECKED");
									}
									?>/> 
								</td>
								<td style="text-align:center;">
									<input type="checkbox" <?php if ($currentWeekNumber != $weeknumber) echo("disabled");?> name="journalStudent<?=$student->getPersonID()?>" onchange="toggleCheckBox(this.checked, '<?=$student->getPersonID()?>', 'journal')" <?php 
									if ($feedback->getJournal() == 1)
									{
										echo("CHECKED");
									}
									?>/> 
								</td>
								<td style="text-align:center;">
									<select <?php if ($currentWeekNumber != $weeknumber) echo("disabled");?> id="onTargetStudent<?=$student->getPersonID()?>" name="onTargetStudent<?=$student->getPersonID()?>" onchange="loadScriptPage('services/weekleyMeetingScript.php?id=<?=$student->getPersonID()?>value='+document.getElementById('onTargetStudent<?=$student->getPersonID()?>').selectedIndex+'&mode=onTarget')"> 
										<option name="N/A">-----------</option>
										<option name="Below Target" <?php if ($feedback->getOnTarget()==1) echo("selected"); ?> value="1">Below Target</option>
										<option name="On Target" <?php if ($feedback->getOnTarget()==2) echo("selected"); ?> value="2">On Target</option>
										<option name="Above Target"<?php if ($feedback->getOnTarget()==3) echo("selected"); ?> value="3"> Above Target</option> 
									</select>
								</td> 
							</tr>
						</table>
					</div>
					<div id="Student<?=$student->getPersonID()?>" class="expandableWindowContent">
						<form>
							<table style="width:100%;">
								<tr>
									<td>
										<br><h4>Notes</h4>
										<textarea <?php if ($currentWeekNumber != $weeknumber) echo("readonly");?> onblur="loadScriptPage('services/weekleyMeetingScript.php?id=<?=$student->getPersonID()?>&text='+notesStudent<?=$student->getPersonID()?>.value+'&mode=notes')" rows="5" cols="20" style="width:90%; font: normal 100% Tahoma,sans-serif;" name="notesStudent<?=$student->getPersonID()?>"><?=$feedback->getNotes()?></textarea>
										<?php 
										$previousFeedback = new Feedback();
										if ($currentWeekNumber > 1)
										{
											$previousFeedback = Feedback::fromDatabaseStudentWeek($student->getPersonID(), $currentWeekNumber-1);
										?>
										<br><h4>Previous Weeks Note</h4>
										<textarea rows="5" cols="20" style="width:90%; font: normal 100% Tahoma,sans-serif;" name="previousnotesStudent<?=$student->getPersonID()?>" readonly><?=$previousFeedback->getNotes()?></textarea>

										<?php 
										}
										?>
									</td> 
									<td> 
										<br><h4>Feedback To Student</h4>
										<textarea rows="5" <?php if ($currentWeekNumber != $weeknumber) echo("readonly");?> onblur="loadScriptPage('services/weekleyMeetingScript.php?id=<?=$student->getPersonID()?>&text='+feedbackStudent<?=$student->getPersonID()?>.value+'&mode=feedback')" cols="20" style="width:90%; font: normal 100% Tahoma,sans-serif;" name="feedbackStudent<?=$student->getPersonID()?>"><?=$feedback->getStudentFeedback()?></textarea>
										<?php
										if ($currentWeekNumber > 1)
										{ 
										?>
										<br><h4>Previous Weeks Feedback To Student</h4>
										<textarea rows="5" cols="20" style="width:90%; font: normal 100% Tahoma,sans-serif;" name="previousFeedBackStudent<?=$student->getPersonID()?>" readonly><?=$previousFeedback->getStudentFeedback()?></textarea>
										<?php
										}
										?>
									</td> 
								</tr>
							</table> 
						</form>
					</div>
				</div>
				<br>
				
	<?php
				}
			}
		}
		 
	?>

<?php
	}
  }
	
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Weekly Meeting Over view";
  //Apply the template
  include("master.php");
 ?>
