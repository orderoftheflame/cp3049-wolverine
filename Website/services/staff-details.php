<?php
include('init.php');
//TODO: DD-This could/should be converted to an XML service and we could parse the content using a specialised class, however,
//there isn't enough time in the project, so I'm sticking with just the render as it is...
$query = $_GET['q'];
if (!is_null($query)){
	echo '<p><span class="left">Placeholder</span><span class="right">This is empty</span></p>';
}else{
echo 'Error: Query was null';
}
?>