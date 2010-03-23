<?php
include('init.php');
//TODO: DD-This could/should be converted to an XML service and we could parse the content using a specialised class, however,
//there isn't enough time in the project, so I'm sticking with just the render as it is...
$query = $_GET['q'];
if (!is_null($query)){
	$staff = Person::fromDatabase($query);
	echo '<div id="staffServicePanel">';
echo <<< DETAIL
	<p><span class="left">Name</span><span class="right">{$staff->getForename()} {$staff->getSurname()}</span></p>
	<p><span class="left">Email</span><span class="right">{$staff->getEmail()}</span></p>
DETAIL;
$admin='No';
$moduleLeader='No';
if ($staff->isAdmin()){
$admin='Yes';
}
if ($staff->isModuleLeader()){
$moduleLeader='Yes';
}

$groups = StudentGroupCollection::fromDatabaseStaff($query);
$groupBindings = "";
foreach($groups->getGroups() as $group){
$groupText = $group->getTitle().' - '.substr($group->getDay(),0,3).' at '.substr($group->getTime(),0,5);
	$groupBindings .= Utility::optionBind($group->getGroupID(),$groupText);
}
$groups = StudentGroupCollection::fromDatabaseUnassigned();
$groupBindingsUnassigned = "";
foreach($groups->getGroups() as $group){
$groupText = $group->getTitle().' - '.substr($group->getDay(),0,3).' at '.substr($group->getTime(),0,5);
	$groupBindingsUnassigned .= Utility::optionBind($group->getGroupID(),$groupText);
}

echo '<p><span class="left">Admin</span><span class="right">'.$admin.'</span></p>';
echo '<p><span class="left">Module Leader</span><span class="right">'.$moduleLeader.'</span></p>';
echo '<p><span class="left">My Groups:</span><span class="right"><select id="ddlAssignedGroups_Staff" name="ddlAssignedGroups_Staff">'.$groupBindings.'</select></span></p>';
$serviceCallUnAssign = "runSpecial('ddlAssignedGroups_Staff','services/unassign-group.php','".$query."','groupResult')";
$refreshPanelCall = "callService('services/staff-details.php','".$query."','staffServicePanel')";

echo '<p class="clearer"><a href="#" class="yellow bordered button" onclick="'.$serviceCallUnAssign.'; '.$refreshPanelCall.'">Remove selected</a></p>';
echo '<p><span class="left">Unassigned Groups:</span><span class="right"><select name="ddlUnassignedGroups_Staff" id="ddlUnassignedGroups_Staff">'.$groupBindingsUnassigned.'</select></span></p>';

//DD- The service needs to be more secure, since anyone could call it and assign groups otherwise.

//REFRESH DATA
$serviceCall = "runSpecial('ddlUnassignedGroups_Staff','services/assign-group.php','".$query."','groupResult')";
echo '<p class="clearer"><a href="#" class="yellow bordered button" onclick="'.$serviceCall.'; '.$refreshPanelCall.'">Add selected</a></p>';
echo '<div id="groupResult">&nbsp;</div>';

echo '</div>'; //End of service panel

}else{
echo 'Error: Query was null';
}
?>
