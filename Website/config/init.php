<?php
//Classes
include_once('classes/class.contact.php');
include_once('classes/class.person.php');
include_once('classes/class.staff.php');
include_once('classes/class.student.php');
include_once('classes/class.studentgroup.php');
include_once('classes/class.project.php');
include_once('classes/class.databaseconnection.php');
include_once('classes/class.projectcollection.php');
include_once('classes/class.personcollection.php');
include_once('classes/class.studentgroupcollection.php');

include_once('classes/class.utility.php');
session_start();	
DatabaseConnection::get();
?>
