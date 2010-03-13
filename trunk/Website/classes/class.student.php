<?php

class Student extends Person{
	protected $chosenProject;
	protected $reader;
	protected $supervisor;

	//Database
	public static function fromRow($row){
		$student = new Student();
		$student = parent::fromRow($row);
	}
	public static function validateLogin($username, $password){
		return parent::validateLogin($username, $password);
	}
  public function getUserType(){
  return 'Student';
  }
}
?>
