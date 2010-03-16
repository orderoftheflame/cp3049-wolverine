<?php include('config/init.php'); ?>
<?php

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
			//xmlhttp.open("GET",url,true);
			alert("xmlhttp.open(\"GET\","+url+",true)")
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
		loadScriptPage("WeekleyMeetingScript.php?mode="+mode+"&flag="+featuredFlag);
	}

	</script>
	<!--put this in loop calling sutents for this supervisor-->
	<div class="windowContainer"> 
		<div class="StudentFeedbackWindowTitle">
			<div style="float:right; font-size:140%; font-weight:normal; padding-right:5px; cursor:pointer;" onclick="toggleWindow('Student1',0,150);">[Show Feedback]</div>
			<div class="StudentName">0613584 - Andrew Cashmore - Week 1</div>
		</div>
		<div id="Student1" class="expandableWindowContent">
			<form>
				<br><h4>Feedback</h4> 
				<textarea rows="7" cols="20" style="width:50%; font: normal 100% Tahoma,sans-serif;" name="previousFeedBackStudent1" readonly>Last weeks feedback etc etc etc</textarea>
			</form> 
		</div>
	</div>
	<br>
	<div class="windowContainer"> 
		<div class="StudentFeedbackWindowTitle">
			<div style="float:right; font-size:140%; font-weight:normal; padding-right:5px; cursor:pointer;" onclick="toggleWindow('Student2',0,150);">[Show Feedback]</div>
			<div class="StudentName">0613584 - Andrew Cashmore - Week 2</div>
		</div>
		<div id="Student2" class="expandableWindowContent">
			<form> 
				<br><h4>Feedback</h4> 
				<textarea rows="7" cols="20" style="width:50%; font: normal 100% Tahoma,sans-serif;" name="previousFeedBackStudent1" readonly>Last weeks feedback etc etc etc</textarea>
			</form> 
		</div>
	</div>
	<br>
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
