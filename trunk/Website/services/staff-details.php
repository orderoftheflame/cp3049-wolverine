<?php
include('init.php');
//TODO: DD-This could/should be converted to an XML service and we could parse the content using a specialised class, however,
//there isn't enough time in the project, so I'm sticking with just the render as it is...
$query = $_GET['q'];
if (!is_null($query)){
	$staff = Person::fromDatabase($query);
echo <<< DETAIL
	<p><span class="left">Name</span><span class="right">{$staff->getForename()} {$staff->getSurname()}</span></p>
	<p><span class="left">Email</span><span class="right">{$staff->getEmail()}</span></p>
	<p><span class="left">Groups:</span><span class="right">Total: 2 (<a href="#" onclick="Effect.toggle('staffGroups', 'slide'); return false;">Show/Hide</a>)</span></p>
	<div id="staffGroups" class="clearer" style="display:none;"><div>
	Group A - Mon at 09:00<br />
	Group B - Tue at 10:00<br />
	</div></div>
DETAIL;
}else{
echo 'Error: Query was null';
}
?>