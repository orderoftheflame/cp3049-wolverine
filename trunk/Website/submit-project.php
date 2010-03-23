<?php include('config/init.php'); ?>
<?php

	$user = Person::getLoggedInUser();
  //Buffer larger content areas like the main page content
  ob_start();
  
  if (is_null($user)){
    $rawError = "You are not logged in, please login to submit projects";
    include('error.php');
  }else{
   $pr01 = Project::fromDatabasePerson($user->getPersonID());
    if (!is_null($pr01)){
      if (!$user->isStaff()){
        if ($_GET['remove']){
          $pr01->remove();
          $rawError='Project removed, <a href="submit-project.php">click here to continue.</a>';
          include('message.php');
        }else{
        $rawError = "<p>You already have your PR01 submitted, you cannot submit again. You can remove the PR01 submission if it has not yet been accepted.</p>";
        $rawError.= "<p>Title: <strong>".$pr01->getTitle()."</strong></p>";
        $rawError.= "<p>Details: <strong>".$pr01->getDetails()."</strong></p>";
        $confirmBox = "return confirm('Are you sure you wish to remove your PR01?')";
        $rawError.= '<p><a href="submit-project.php?remove=true" class="yellow button margin padded bordered" onClick="'.$confirmBox.'">Remove PR01</a>';
        include('error.php');
        }
      }
    }
  if (!is_null($_POST['txtProjectTitle'])){
    $project = Project::withParameters($_POST['txtProjectTitle'], $_POST['txtProjectContent'], $user->getPersonID());
    $project->submit();
  
    if ($user->isStaff()){
      echo '<h1>Idea Submitted</h1><p>Your project idea has been submitted, students can now review and select your project idea, if you have selected to be notifed when a student chooses your project, an e-mail will be sent to your when this happens.</p>';
    }else{
      echo '<h1>PR01 Submitted</h1><p>Your project idea has been submitted, you must now wait for the project to be approved by a supervisor, if you wish to edit the project in the mean time, please go to <a href="my-account.php">your account area</a>.</p>';
    }
  
    ?>
    <?php
  }else{
  
  ?>
  <h1>Submit a project (PR01)</h1>
  <form action="<?php echo $_PHP_SELF; ?>" method="POST" name="frmSubmitProject">
  
  <label for="txtProjectTitle">Project Title:</label>
  <input type="text" name="txtProjectTitle" length="256" class="max-width" />
  <label for="txtProjectContent">Project Details:</label>
  <textarea name="txtProjectContent" length="5000"></textarea>
  
  <div class="left margin clearer half-width"><label for="ddlCategories">Categories:
<select name="ddlCategories" id="ddlCategories">
<?php
//$parentCategories = CategoryCollection::fromDatabase();
//foreach($parentCategories->getCategories() as $category){
//echo '<option value="'.$category->getCategoryID().'">'.$category->getName().'</option>';
//}
echo '<option value="1">IP Project - Long Thin</option>';
echo '<option value="2">IP Project - Short Fat</option>';
echo '<option value="3">PDP Project</option>';

?>
</select>

<a href="#" class="yellow bordered margin button" onClick="addCategory();">Add</a>

</div>
<div id="divCategories" class="right margin half-width">
<select name="ddlSelectedCategories[]" id="ddlSelectedCategories" class="max-width" size="3" multiple="multiple">
</select>
<a href="#" class="right yellow bordered margin button" onClick="removeAll();">Clear All</a>
<a href="#" class="right yellow bordered margin button" onClick="removeOptionSelected();">Remove Selected</a>
</div>

<div class="clearer">

<?php
if ($user->isStaff()){
?>
<input type="checkbox" name="chkNotifyMe" value="notify"> Notify me when students choose this project.
<?php } ?>
</div>
  <div class="clearer right">
  <input type="submit" value="Submit" name="btnProjectSubmit" class="yellow button bordered margin" />
  </div>
  </form>
  <?php
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
