<?php

class Staff extends Person{
protected $readsForStudents; //Student Collection
protected $superviseStudents; //Student Collection
protected $isAdmin;
protected $isModuleLeader;
public static function withParameters($personID, $forename, $surname, $password, $email)
{
	$user = new Staff();

	$user->setPersonID($personID);
	$user->setPassword($password);
	$user->setForename($forename);
	$user->setSurname($surname);
	$user->setEmail($email);
	$user->loadRoles();	
	
	return $user;
}

public function loadRoles(){
	$sql="SELECT *  FROM wv_staff";
  $sql.=" WHERE VchPersonIDFK = '".$this->personID."'";
	
	$result = mysql_query($sql) or die('Error: '.mysql_error ());
	while($row = mysql_fetch_array($result))
	{
	 $this->isAdmin = ($row['BitIsAdmin'] == 1 ? true : false);
	 $this->isModuleLeader = ($row['BitIsModuleLeader'] == 1 ? true : false);
	 return;
	}
}
public function isStaff(){
return $this->isModuleLeader;
}
public function isAdmin(){
return $this->isAdmin;
}
private function login(){
	session_register ("loggedIn");
	$_SESSION ["loggedIn"] = $this;
}


}
?>
