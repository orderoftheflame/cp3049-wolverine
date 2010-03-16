<form action="manage-staff.php" method="POST" name="frmManageStaff">

<select name="ddlSupervisors" id="ddlSupervisors" class="max-width" onchange="callService('services/staff-details.php',this.value,'loadedDetails');" size="10">
<?php
$staff = PersonCollection::fromDatabaseStaff();
foreach($staff->getPeople() as $staffMember){
	$staffText = $staffMember->getForename().' '.$staffMember->getSurname();
	echo Utility::optionBind($staffMember->getPersonID(),$staffText);
}
?>
</select>
<a href="#" class="yellow bordered padded button">Remove Staff</a>

<div id="staffDetail" class="clearer">
<h2>Selected staff details: (<a href="#" onclick="Effect.toggle('loadedDetails', 'slide'); return false;">Show/Hide</a>)</h2>
<div id="loadedDetails" >Select a member of staff</div>
</div>
	</form>
