<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>
<?php 
DatabaseConnection::Close();

 if (is_null($page_title)){
		?>
Wolverine :: Project Management System
<?php }else {echo $page_title; } ?>
</title>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/scriptaculous.js" type="text/javascript"></script>
<script src="js/utility.js" type="text/javascript"></script>
<script src="js/ajax_query.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="default.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
if (!is_null($page_heads)){
echo $page_heads;
}
?>
</head>
<body <?php echo is_null($page_onload) ? '' : 'onload='.$page_onload; ?>>
<div id="outerwrapper">
    <div id="wrapper">
<div class="top">
				
	<div class="header">
	<div class="left">
Wolverine
</div>
<div>
<img src="img/logo.png" class="right" alt="Site logo" /> 
</div>
	</div>	

</div>

<div class="container">	

	<div class="navigation">
		<a href="index.php" class="main-link" title="Home">HOME</a>
		<a href="contact-us.php" class="main-link"  title="Our contact details and a contact form provided for you to get in touch">CONTACT US</a>
		
		<?php 
		$loggedInUser = Person::getLoggedInUser();
		if (!is_null($loggedInUser)){
    echo '<a href="my-account.php" class="main-link">YOUR ACCOUNT</a>';
    echo '<a href="submit-project.php" class="main-link" >SUBMIT PROJECT</a>';
    echo '<a href="view-projects.php" class="main-link" >VIEW PROJECT IDEAS</a>';
    }else{
    echo '<a href="login-register.php" class="main-link"  title="Sign up or login">LOGIN / REGISTER</a>';
    }
		
		echo $page_toplinks;  
	  ?>
		<div id="loginControl">
		<?php
		
			if (!is_null($loggedInUser)){
				echo 'Welcome <strong>'.$loggedInUser->getForename().'</strong>. <a href="login-register.php?action=logout">Sign out</a>';
			}
		?>
		</div>
<div class="clearer"><span></span></div>
	</div>

	<div class="main">

		<div class="sidenav">
			<?php 
  if (!is_null($loggedInUser)){
    if ($loggedInUser->isAdmin()){
      echo '<h2>Administration</h2>';
      echo '<ul>';
      echo '<li><a href="assign-students.php">Assign Students</a></li>';
      echo '<li><a href="manage-staff.php">Manage Staff</a></li>';
	  echo '<li><a href="manage-groups.php">Manage Student Groups</a></li>';
      echo '</ul>';
    }
  }
  
  if (!is_null($loggedInUser)){
    if ($loggedInUser->isStaff()){
      echo '<h2>Staff</h2>';
      echo '<ul>';
      echo '<li><a href="weekly-meetings.php?weeknumber=$weeknumber">Weekly Meetings</a></li>';
      echo '<li><a href="student-groups-overview.php">View My students</a></li>';
      echo '</ul>';
    }
  }
  
   if (!is_null($loggedInUser)){
   if (!$loggedInUser->isStaff()){
      echo '<h2>Student</h2>';
      echo '<ul>';
      echo '<li><a href="student-weekly-feedback.php">Weekly Meeting Feedback</a></li>';
      echo '</ul>';
    }
  }
  ?>

  
		
</div>
	  <div class="content">
	  <?php 
	  if (is_null($page_content)){
	?>
	<h1>Under Construction</h1>
	I guess you beat us to it, this page isn't ready yet, check back later.
	<?php
	  }else{
		  echo $page_content;  
	  }
	  ?>
	  </div>

		

		<div class="clearer"><span></span></div>

	</div>

	<div class="footer">Site design by DCM Solutions (CP3049 RAD TEAM) &copy; 2010 - <a href="http://cp3049.blogspot.com/?zx=3013fb86430ac88b">Blog</a> | <a href="http://code.google.com/p/cp3049-wolverine/">SVN</a>
	</div>

</div>

       
        
        
    </div>
    </div>
</body>
</html>
