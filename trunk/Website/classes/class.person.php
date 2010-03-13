<?php

class Person{
protected $personID;
protected $forename;
protected $surname;
protected $password;
protected $email;
protected $joinDate;

public static function withParameters($personID, $forename, $surname, $password, $email)
{
	$user = new Person();
	$user->setPersonID($personID);
	$user->setPassword($password);
	$user->setForename($forename);
	$user->setSurname($surname);
	$user->setEmail($email);
	return $user;
}
public function isStaff(){
	return false;
}
public function isAdmin(){
	return false;
}
public static function PersonExists($personID){
	$sql="SELECT * FROM wv_person WHERE VchPersonIDPK = '".$personID."'";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	if ($rows >0){
		return true;
	}else{
		return false;
	}
}

public function register(){
	$sql = "INSERT INTO wv_person (VchPersonIDPK, VchPersonPassword,VchPersonForeName,VchPersonLastName, VchPersonEmail, DateTimePersonRegistered ) VALUES (
	'".$this->getPersonID()."',
	'".sha1($this->getPersonID().$this->getPassword())."',
	'".$this->getForename()."',
	'".$this->getSurname()."',
	'".$this->getEmail()."',
	'".date('Y-m-d H:i:s')."'
	)";

	mysql_query($sql) or die('Error: '.mysql_error ());

	$this->login();
}
public static function baseQuery(){
	$sql="SELECT wv_person.*, wv_staff.VchPersonIDFK as VchStaffID FROM wv_person";
  $sql.=" LEFT JOIN (wv_staff) ON (wv_staff.VchPersonIDFK = wv_person.VchPersonIDPK)";
  return $sql;
}
public static function fromRow($row){
	$personID = $row['VchPersonIDPK'];
	$password = $row['VchPersonPassword'];
	$forename = $row['VchPersonForeName'];
	$surname = $row['VchPersonLastName'];
	$email = $row['VchPersonEmail'];
	$joinDate = $row['DateTimePersonRegistered'];
	$staffNum = $row['VchStaffID'];
	 if (!is_null($staffNum)){
    //User is a member of staff
		$user = Staff::withParameters($personID, $forename, $surname, $password, $email);
	}else{
		$user = Student::withParameters($personID, $forename, $surname, $password, $email);
	}
	$user->setJoinDate($joinDate);
	
	return $user;
}
public static function validateLogin($username, $password){
	$passwordHash = sha1($username.$password);
	$sql= Person::baseQuery();
	$sql.=" WHERE VchPersonIDPK = '".$username."'"." AND vchPersonPassword = '".$passwordHash."'";
	$result = mysql_query($sql) or die('Error: '.mysql_error ());
	while($row = mysql_fetch_array($result))
	{
		$user = Person::fromRow($row);
		$user->login();
		return $user;
	}
	return null;
}
private function login(){
	session_register ("loggedIn");
	$_SESSION ["loggedIn"] = $this;
}
public static function logout(){
	session_unregister ("loggedIn"); 
}

public static function getLoggedInUser(){
	if (is_null($_SESSION ["loggedIn"]))
		return null;
 
  $p = $_SESSION["loggedIn"];
  
	return $p;
}
public function setJoinDate($value){
$this->joinDate = $value;
}
public function setPersonID($value){
$this->personID = $value;
}
public function setForename($value){
$this->forename = $value;
}
public function setSurname($value){
$this->surname = $value;
}
public function setPassword($value){
$this->password = $value;
}
public function setEmail($value){
$this->email = $value;
}

public function getJoinDate(){
return $this->joinDate;
}
public function getPersonID(){
return $this->personID;
}
public function getForename(){
return $this->forename;
}
public function getSurname(){
return $this->surname;
}
public function getPassword(){
return $this->password;
}
public function getEmail(){
return $this->email;
}
}
?>
