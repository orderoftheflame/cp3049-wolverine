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
	
	<form>
	<table border="1"> 
		<tr>
			<th>
				Assessment Criteria
			</th>
			<th>
				A
			</th>
			<th>
				B
			</th>
			<th>
				C
			</th>
			<th>
				D 
			</th>
			<th>
				E
			</th>
			<th>
				F
			</th>
		</tr>
		<tr>
			<td style="font-weight:bold; vertical-align:top;">
				Aim, Objectives &amp;
				confirmation of the Objectives
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1A"/></p>
				Aim stated clearly of
				what is to be achieved.<br/><br/>
				The objectives are
				appropriate for the
				intended project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1B"/> </p>
				Aim stated clearly of
				what is to be achieved.<br/><br/>
				The objectives are
				mainly appropriate for
				the intended project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1C"/> </p>
				Aim not expressed
				clearly.<br/><br/>
				Most of the objectives
				are appropriate for the
				intended project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1D"/> </p>
				Somewhat confused
				statement made of what
				is to be achieved.<br/><br/>
				Some of the objectives
				are appropriate for the
				intended project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1E"/> </p>
				Unable to distinguish
				between aim and
				objectives.<br/><br/>
				Objectives not stated
				clearly and are
				inappropriate. 
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="1F"/> </p>
				Very poor in all aspects.
				
			</td>
		</tr>
		<tr>
			<td style="font-weight:bold; vertical-align:top;">
				Initial Literature Review
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2A"/> </p>
				A very good attempt at
				establishing the context
				of the project.<br/><br/>
				Very good attempt made
				to identify relevant
				literature sources that
				academically underpin
				the project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2B"/> </p>
				Good attempt at
				establishing the context
				of the project.<br/><br/>
				Good attempt made to
				identify relevant
				literature sources that
				academically underpin
				the project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2C"/> </p>
				Satisfactory attempt at
				establishing the context
				of the project.<br/><br/>
				Satisfactory attempt
				made to identify relevant
				literature that
				academically underpins
				the project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2D"/> </p>
				The context in which the
				project is set is limited.<br/></br>
				Limited attempt made to
				identify relevant
				literature that 
				academically underpins
				the project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2E"/> </p>
				There is little attempt to
				put the project into
				context.<br/><br/>
				The relevant literature
				that academically
				underpins the project is
				taken from a limited
				range of sources - some
				irrelevant to the project.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="2F"/> </p>
				Very poor in all aspects.
				
			</td>
		</tr>
		<tr>
			<td style="font-weight:bold; vertical-align:top;">
				Interim deliverables and results
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3A"/> </p>
				A very good attempt at
				communicating some of
				the final deliverables,
				key developments or
				interim products.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3B"/> </p>
				A good attempt at
				communicating some of
				the final deliverables,
				key developments or
				interim products.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3C"/> </p>
				A satisfactory attempt at
				communicating some of
				the final deliverables,
				key developments or
				interim products
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3D"/> </p>
				A limited attempt at
				communicating some of
				the final deliverables,
				key developments or
				interim products.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3E"/> </p>
				There is little attempt at
				communicating any of
				the final deliverables,
				key developments or
				interim products.
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="3F"/> </p>
				Very poor in all aspects.
				
			</td>
		</tr>
		<tr>
			<td style="font-weight:bold; vertical-align:top;">
				Progress and plans
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4A"/> </p>
				A very good attempt at
				providing a summary of:
				<li> activities completed
				to date</li>
				<li> issues encountered
				and the measures
				taken</li>
				<li> activities to be
				completed</li>
				<li> Project approach</li>
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4B"/> </p>
				A good attempt at
				providing a summary of:
				<li> activities completed
				to date</li>
				<li> issues encountered
				and the measures
				taken</li>
				<li> activities to be  
				completed</li>
				<li> Project approach</li>
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4C"/> </p>
				A satisfactory attempt at
				providing a summary of:
				<li> activities completed
				to date</li>
				<li> issues encountered
				and the measures
				taken</li>
				<li> activities to be
				completed</li>
				<li> Project approach</li>
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4D"/> </p>
				A limited attempt at
				providing a summary of:
				<li> activities completed
				to date</li>
				<li> issues encountered
				and the measures
				taken</li>
				<li> activities to be
				completed</li>
				<li> Project approach</li>
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4E"/> </p>
				Little attempt at
				providing a summary of:
				<li> activities completed
				to date</li>
				<li> issues encountered
				and the measures
				taken</li>
				<li> activities to be
				completed</li>
				<li> Project approach</li>
				
			</td>
			<td style="vertical-align:top;"><p style="text-align:center"><input type="checkbox" name="4F"/> </p>
				Very poor in all aspects.
				
			</td>
		</tr>
		<tr>
			<td colspan="5">
				Feedback<br>
				<textarea style="width:80%;"cols="30" rows="7"></textarea>
			</td>
			<td colspan="2" valign="top">
				Grade
				<input type="text">
				<input type="submit" value="complete marking">
			</td>
		</tr>
	</table>
	
	</form>
	
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
