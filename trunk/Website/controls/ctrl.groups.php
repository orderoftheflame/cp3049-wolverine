<form action="manage-groups.php" method="POST" name="frmManageGroups">
<select name="ddlSupervisors" id="ddlSupervisors" class="max-width" onchange="callService('services/group-details.php',this.value,'loadedGroupDetails');" size="10">
<?php
$groups = StudentGroupCollection::fromDatabase();
foreach($groups->getGroups() as $group){
$groupText = $group->getTitle().' - '.substr($group->getDay(),0,3).' at '.substr($group->getTime(),0,5);
	echo Utility::optionBind($group->getGroupID(),$groupText);
}
?>
</select>
<input type="submit" onclick="return confirm('Are you sure? Any students in the group will become unassigned')" class="yellow bordered margin button" name="btnRemoveGroup" id="btnRemoveGroup" value="Remove Group" />
<div id="groupDetail" class="clearer">
<h2>Selected group details:</h2>
<div id="loadedGroupDetails">Select a group</div>
</div>
	</form>