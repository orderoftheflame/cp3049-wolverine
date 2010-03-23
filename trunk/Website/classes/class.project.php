<?php

class Project{
protected $projectID;
protected $title;
protected $details;
protected $author;
protected $projectType;

public static function withParameters($title, $details, $author)
{
	$project = new Project();
	$project->setTitle($title);
	$project->setDetails($details);
	$project->setAuthor($author);
	return $project;
}
public static function fromDatabasePerson($studentID){
  $sql = "SELECT * FROM wv_project WHERE VchSubmittedByFK = '".$studentID."'";
  $queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
      while($row = mysql_fetch_array($queryResult))
      {
        $project = Project::fromRow($row);
        return $project;
      }
}
//Database
public static function fromRow($row){
	$projectID = $row['IntProjectIDPK'];
	$title = $row['VchProjectTitle'];
	$details = $row['VchProjectDetails'];
	$author = $row['VchSubmittedByFK'];
	
	$project = Project::withParameters($title, $details, $author);
	$project->setProjectID($projectID);
	return $project;
}
public function remove(){
    $sql = "DELETE FROM wv_project WHERE IntProjectIDPK = ".$this->getProjectID();
    echo $sql;
    mysql_query($sql) or die('Error: '.mysql_error ());
}
public function submit(){
  $sql = "INSERT INTO wv_project (VchProjectTitle, VchProjectDetails, VchSubmittedByFK, DateTimeSubmitted)
  VALUES (
    '".$this->getTitle()."',
    '".$this->getDetails()."',
    '".$this->getAuthor()."',
    '".date('Y-m-d H:i:s')."'
  )";
  mysql_query($sql) or die('Error: '.mysql_error ());
}

//Getters and setters
public function setProjectID($value){
	$this->projectID = $value;
}
public function setTitle($value){
	$this->title = $value;
}
public function setDetails($value){
	$this->details = $value;
}
public function setAuthor($value){
	$this->author = $value;
}


public function getProjectID(){
	return $this->projectID;
}
public function getTitle(){
	return $this->title;
}
public function getDetails(){
	return $this->details;
}
public function getAuthor(){
	return $this->author;
}
}
?>
