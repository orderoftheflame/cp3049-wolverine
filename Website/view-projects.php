<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  ob_start();
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
	<h1>View project ideas!</h1> 
	<p>This list contains all of the ideas that have been submitted by staff for students to accept as their project, you can select on of these for your PR01 submission, or create your own.</p>
	<ul>
	<li class="article-listentry"><div class="left"><strong>Online project management system</strong></div><div class="right">By: Derek Beardsmore | <a href="#" onclick="toggleWindow('article1',0,270);">View</a></div>
  <div id="article1" class="expandableWindowContent clearer"><p>Create a new project managment system to help manage students working on projects in thir final year.</p></div>
  
  </li>
	<li class="article-listentry"><div class="left"><strong>Mathematics training website</strong></div><div class="right">By: Matthew Burley | <a href="#" onclick="toggleWindow('article2',0,270);">View</a></div> 
  <div id="article2" class="expandableWindowContent clearer"><p>A training program to help students brush up on their math skills.</p></div>
  </li>
	</ul>
	
<?php
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  $page_title = "View Project Ideas";
  ob_end_clean();
  //Apply the template
  include("master.php");
?>
	  


