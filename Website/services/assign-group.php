<?php
include('init.php');
//TODO: DD-This could/should be converted to an XML service and we could parse the content using a specialised class, however,
//there isn't enough time in the project, so I'm sticking with just the render as it is...
$groupID = $_GET['q'];
$staffNum = $_GET['q2'];
if (!is_null($staffNum) && !is_null($groupID)){
	$group = StudentGroup::fromDatabase($groupID);
	$staff = Staff::fromDatabase($staffNum);
	if (!is_null($staff) && !is_null($group)){
		$group->assignGroupToStaff($staffNum);
		echo 'Group assigned';
	}
}else{
echo 'Error: Query was null';
}
?>
