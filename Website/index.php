<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>
<div class="left half-width">	    
	<h1>Welcome!</h1> 
	<p>Welcome to the new project management system, if you have any questions about the new site, feel free to <a href="contact-us.php">contact us</a></p>
</div>
<div class="right half-width"><img src="img/home_side.jpg" class="right" alt="Project Management"  /></div>

<?php
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  //Apply the template
  include("master.php");
?>
	  


