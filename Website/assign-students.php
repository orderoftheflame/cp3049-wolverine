<?php include('config/init.php'); ?>
<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<h1>Assign students to supervisors</h1> 

<div class="left half-width bordered padded">
<form id="frmAddStudents" name="frmAddStudents">
<h2>Unassigned Students</h2>
With selected: <br /><input type="submit" value="Add to group" class="yellow bordered button" />
<ul class="clearer">
<?php 
$students = PersonCollection::fromDatabaseUnassignedStudents();
foreach ($students->getPeople() as $student){
  $effect1 = "Effect.toggle('article".$student->getPersonID()."', 'slide'); return false;";
  $effect2 = "Effect.toggle('article2".$student->getPersonID()."', 'slide'); return false;";
  echo '
  <li class="article-listentry">
  <div class="left"><strong>'.$student->getPersonID().' - '.$student->getForename().'</strong></div>
  <div class="left clearer">
  <input type="checkbox" /> |
  <a href="#" onclick="'.$effect1.'">View PR01</a> | 
  <a href="#" onclick="'.$effect2.'">View PR02</a> 
  </div>
  <div id="article'.$student->getPersonID().'" class="clearer" style="display:none;"><p>This is my Pr01</p></div>
  <div id="article2'.$student->getPersonID().'" class="clearer" style="display:none;"><p>This is my Pr02</p></div>
  
  
  </li>';
}

?>
</ul>
</form>
</div>
<div class="right half-width bordered padded">
<h2>Groups</h2>
<?php 
$showAssignedOnly = true;
include('controls/ctrl.groups.php'); ?>
</div>

<?php
//Assign all Page Specific variables
$page_content = ob_get_contents();
$page_title = "Manage Students";
ob_end_clean();
//Apply the template
include("master.php");
?>



