<?php

class StudentGroup{
protected $groupID;
protected $groupTitle;
protected $details;
protected $studentsCollection;

public static function withParameters($groupTitle, $details)
{
	$group = new StudentGroup();
	$group->setTitle($groupTitle);
	$group->setDetails($details);
	return $project;
}

//Database
public static function fromRow($row){
	$groupID = $row['IntGroupID'];
	$title = $row['VchGroupTitle'];
	$details = $row['vchGroupDetails'];
	
	$group = StudentGroup::withParameters($title, $details);
	$group->setGroupID($groupID);
	return $group;
}

public function save(){
  $sql = "INSERT INTO wv_studentgroups (VchGroupTitle, VchGroupDetails, DateTimeCreated)
  VALUES (
    ".$this->getTitle().",
    ".$this->getDetails().",
    ".date('Y-m-d H:i:s')."
  )";
}

//Getters and setters
public function setGrouptID($value){
	$this->groupID = $value;
}
public function setTitle($value){
	$this->title = $value;
}
public function setDetails($value){
	$this->details = $value;
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
}
?>
