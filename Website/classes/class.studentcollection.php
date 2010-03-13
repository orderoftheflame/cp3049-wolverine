<?php
class StudentCollection{
	protected $students = array();
	private $totalStudents = 0;
	
	//Adds to collection
	public function add($value) {
		$this->students[$this->totalStudents++] = $value;
	}
	
	public static function fromDatabase()
	{  
		$sql = "SELECT * FROM tblStudents";
		return StudentCollection::executeQuery($sql);
	}
	
    public static function fromDatabaseSearch($keywords)
	{  
		$sql = "SELECT * FROM tblStudents WHERE vchForename LIKE '%".$keywords."%' OR vchSurname LIKE '".$keywords."'";
		return StudentCollection::executeQuery($sql);
	}
	
    protected static function executeQuery($sql){
      $studentCollection = new StudentCollection();
      $queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
      while($row = mysql_fetch_array($queryResult))
      {
        $student = Student::fromRow($row);
        $studentCollection->add($student);
      }
      return $studentCollection;
    }
	
	public function getStudents(){
		return $this->students;
	}
	
	public function getStudentsCount(){
		return $this->totalStudents;
	}
	
}

?>