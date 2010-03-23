<?php include('config/init.php'); ?>
<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>
	<h1>View project ideas!</h1> 
	<p>This list contains all of the ideas that have been submitted by staff for students to accept as their project, you can select on of these for your PR01 submission, or create your own.</p>
	<ul>
	<?php
    $projects = ProjectCollection::fromDatabaseStaffIdeas();
    foreach($projects->getProjects() as $project){
      $effect = "Effect.toggle('article".$project->getProjectID()."', 'slide'); return false;";
      echo '<li class="article-listentry">
      <div class="left"><strong>'.$project->getTitle().'</strong></div>
      <div class="right">By: '.$project->getAuthor().' | <a href="#" onclick="'.$effect.'">View</a></div>
      
      <div id="article'.$project->getProjectID().'" class="clearer" style="display:none">
      <p>'.$project->getDetails().'</p></div>

      </li>
      ';
    }
   ?>
	</ul>
	
<?php
  //Assign all Page Specific variables
  $page_content = ob_get_contents();
  $page_title = "View Project Ideas";
  ob_end_clean();
  //Apply the template
  include("master.php");
?>
	  


