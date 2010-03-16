<?php include('config/init.php'); ?>
<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<h1>Assign students to supervisors</h1> 

<div class="left half-width bordered padded">
<form id="frmAddStudents" name="frmAddStudents">
<h2>Unassigned Students</h2>
With selected: <br /><input type="submit" value="Add to supervisor" class="yellow bordered button" />
<ul class="clearer">
<li class="article-listentry"><div class="left"><strong>0601163 - Daniel Dawes</strong></div>

<div class="left clearer">
<input type="checkbox" /> |
<a href="#" onclick="Effect.toggle('article1', 'slide'); return false;">View PR01</a> | 
<a href="#" onclick="Effect.toggle('article1_2', 'slide'); return false;">View PR02</a> 
</div>
<div id="article1" class="clearer" style="display:none;"><p>This is my Pr01</p></div>
<div id="article1_2" class="clearer" style="display:none;"><p>This is my Pr02</p></div>
</li>

<li class="article-listentry"><div class="left"><strong>0601164 - Andrew Cashmore</strong></div>
<div class="left clearer">
<input type="checkbox" /> |
<a href="#" onclick="Effect.toggle('article2', 'slide'); return false;">View PR01</a> | 
<a href="#" onclick="Effect.toggle('article2_2', 'slide'); return false;">View PR02</a> 

</div> 
<div id="article2" class="clearer" style="display:none;"><p>This is a different PR01</p></div>
<div id="article2_2" class="clearer" style="display:none;"><p>This is a different PR02</p></div>
</li>
</ul>
</form>
</div>
<div class="right half-width bordered padded">
<h2>Supervisors</h2>
<?php include('controls/ctrl.staff.php'); ?>
</div>

<?php
//Assign all Page Specific variables
$page_content = ob_get_contents();
$page_title = "View Project Ideas";
ob_end_clean();
//Apply the template
include("master.php");
?>



