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
	return $project;
}

//Database
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
    ".$this->getTitle().",
    ".$this->getDetails().",
	".$this->getDay().",
	".$this->getTime().",
    ".date('Y-m-d H:i:s')."
  )";
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
	return $this->projectID;
}
public function getTitle(){
	return $this->title;
}
public function getDetails(){
	return $this->details;
}
public function setDay(){
	return $this->day;
}
public function setTime(){
	return $this->time;
}
}
?>
