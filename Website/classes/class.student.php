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
}
?>
