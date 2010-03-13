<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();
	
  
  $user = Person::getLoggedInUser();
  if (is_null($user)){
    $rawError = "You are not logged in, please login to submit projects";
    include('error.php');
  }else{
  
  if (!is_null($_POST['txtTitle'])){
    ?>
    <h1>Message sent</h1>
    Your message has been sent.
    <?php
  }else{
      $rawError = "You have reached this page in error, if this is unexpected, please contact the administrator.";
    include('error.php');
  }
  
  }
  
	
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Account";
  $page_heads ='<script src="js/additem.js" type="text/javascript"></script>';
  //Apply the template
  include("master.php");
?>
