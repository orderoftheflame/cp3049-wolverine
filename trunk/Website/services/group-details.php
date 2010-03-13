<?php
include('init.php');
//TODO: DD-This could/should be converted to an XML service and we could parse the content using a specialised class, however,
//there isn't enough time in the project, so I'm sticking with just the render as it is...
$query = $_GET['q'];
if (!is_null($query)){
	$group = StudentGroup::fromDatabase($query);
	if(!is_null($group)){
		echo '<p><span class="left">Name:</span><span class="right">'.$group->getTitle().'</span></p>';
		echo '<p><span class="left">Details:</span><span class="right">'.$group->getDetails().'</span></p>';
		echo '<p><span class="left">Time: </span><span class="right">'.$group->getDay().' at '.substr($group->getTime(),0,5).'</span></p>';
	}else{
		echo 'Group was not found for the ID '.$_GET['q'];
	}
}else{
echo 'Error: Query was null';
}
?>