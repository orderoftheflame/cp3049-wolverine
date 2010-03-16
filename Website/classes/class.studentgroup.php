<?php

class StudentGroup{
protected $groupID;
protected $groupTitle;
protected $details;
protected $day;
protected $time;
protected $studentsCollection;
//QUERY: Will a group ever meet more than once a week? In that case we need another table to store meeting days/times.
public static function withParameters($groupTitle, $details, $day, $time)
{
	$group = new StudentGroup();
	$group->setTitle($groupTitle);
	$group->setDetails($details);
	$group->setDay($day);
	$group->setTime($time);
	return $group;
}

//Database
public static function fromDatabase($groupID){
	$sql = "SELECT * FROM wv_studentgroups WHERE IntGroupID = ".$groupID;
	$queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
	while($row = mysql_fetch_array($queryResult))
	{
	return StudentGroup::fromRow($row);
	}
}

public static function assignGroupToStaff($staffNumber){
  $sql = "INSERT INTO wv_staffstudentgrouplink (IntGroupID, VchPersonIDFK)
  VALUES (
    ".$this->getGroupID().",
    '".$staffNumber."'
  )";
   mysql_query($sql) or die('Error: '.mysql_error ());
}

public static function fromRow($row){
	$groupID = $row['IntGroupID'];
	$title = $row['VchGroupTitle'];
	$details = $row['VchGroupDetails'];
	$day = $row['VchGroupDay'];
	$time = $row['TimeGroupMeeting'];
	
	$group = StudentGroup::withParameters($title, $details, $day, $time);
	$group->setGroupID($groupID);
	return $group;
}

public function save(){
  $sql = "INSERT INTO wv_studentgroups (VchGroupTitle, VchGroupDetails, VchGroupDay, TimeGroupMeeting, DateTimeCreated)
  VALUES (
    '".$this->getTitle()."',
    '".$this->getDetails()."',
	'".$this->getDay()."',
	'".$this->getTime()."',
    '".date('Y-m-d H:i:s')."'
  )";
   mysql_query($sql) or die('Error: '.mysql_error ());
   $this->setGroupID( mysql_insert_id());
}
//Static so we don't have to instantiate a group object just to delete it
public static function delete($groupID){
//QUERY: DD-Not a huge fan of deleting without archiving, consider archiving this informatinon or implementing soft delete?
	$sql = "DELETE FROM wv_studentgroups WHERE IntGroupID = ".$groupID;
	//TODO: DD-Remove student group links with the group ID we are removing.
	mysql_query($sql) or die('Error: '.mysql_error ());
}
//Getters and setters
public function setGroupID($value){
	$this->groupID = $value;
}
public function setTitle($value){
	$this->title = $value;
}
public function setDetails($value){
	$this->details = $value;
}
public function setDay($value){
	$this->day = $value;
}
public function setTime($value){
	$this->time = $value;
}

public function getGroupID(){
	return $this->groupID;
}
public function getTitle(){
	return $this->title;
}
public function getDetails(){
	return $this->details;
}
public function getDay(){
	return $this->day;
}
public function getTime(){
	return $this->time;
}
}
?>
