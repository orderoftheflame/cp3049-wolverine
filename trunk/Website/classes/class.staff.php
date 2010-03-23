<?php

class Staff extends Person{
protected $readsForStudents; //Student Collection
protected $superviseStudents; //Student Collection
protected $isAdmin;
protected $isModuleLeader;
public static function withParameters($personID, $forename, $surname, $password, $email)
{
	$staffMember = new Staff();

	$staffMember->setPersonID($personID);
	$staffMember->setPassword($password);
	$staffMember->setForename($forename);
	$staffMember->setSurname($surname);
	$staffMember->setEmail($email);
	$staffMember->loadRoles();	
	
	return $staffMember;
}

public function loadRoles(){
	$sql="SELECT *  FROM wv_staff";
  $sql.=" WHERE VchPersonIDFK = '".$this->personID."'";
	
	$result = mysql_query($sql) or die('Error: '.mysql_error ());
	while($row = mysql_fetch_array($result))
	{
	 $this->isAdmin = ($row['BoolIsAdmin'] == 1 ? true : false);
	 $this->isModuleLeader = ($row['BoolIsModuleLeader'] == 1 ? true : false);
	 return;
	}
}
public function isStaff(){
return true;
}
public function isModuleLeader(){
return $this->isModuleLeader;
}
public function isAdmin(){
return $this->isAdmin;
}
private function login(){
	session_register ("loggedIn");
	$_SESSION ["loggedIn"] = $this;
}
public function register($login){
	parent::register($login);
	$sql = " INSERT INTO wv_staff (VchPersonIDFK, BitIsAdmin, BitIsModuleLeader) VALUES (
	'".$this->getPersonID()."',
	".$this->isAdmin().",
	".$this->isModuleLeader()."
	)";
	mysql_query($sql) or die('Error: '.mysql_error ());
}
public function setModuleLeader($value){
$this->isModuleLeader = $value;
}
public function setAdmin($value){
$this->isAdmin = $value;
}

}
?>
