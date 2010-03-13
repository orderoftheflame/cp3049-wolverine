<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  $errorMessage = "Undefined error";
  if (!is_null($rawError) ){
  $errorMessage = $rawError;
  }
  
  ob_start();
?>
<h1>Error</h1>
<p>There was an error during your request:</p> <?php echo $errorMessage ?>
<?php
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  ob_end_clean();
  $page_title = "Error";
  //Apply the template
  include("master.php");
  die();
?>