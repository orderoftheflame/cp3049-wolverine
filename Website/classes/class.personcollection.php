<?php
class PersonCollection{
	protected $people = array();
	private $totalPeople = 0;
	
	//Adds to collection
	public function add($value) {
		$this->people[$this->totalPeople++] = $value;
	}
	
	public static function fromDatabaseAll()
	{  

		$sql=Person::baseQuery();
		
		return PersonCollection::executeQuery($sql);
	}
	public static function fromDatabaseStaff()
	{  
		$sql = Person::baseQuery();
		$sql .= " WHERE wv_staff.VchPersonIDFK IS NOT NULL";
		return PersonCollection::executeQuery($sql);
	}
	public static function fromDatabaseStudents()
	{  
		$sql = Person::baseQuery();
		$sql .= " WHERE wv_staff.VchPersonIDFK IS NULL";
		return PersonCollection::executeQuery($sql);
	}
	public static function fromDatabaseUnassignedStudents()
	{  
		$sql = Person::baseQuery();
		$sql .= " LEFT JOIN wv_personstudentgrouplink link ON link.VchPersonIDFK = wv_person.VchPersonIDPK ";
		$sql .= " WHERE wv_staff.VchPersonIDFK IS NULL";
		$sql .= " AND link.VchPersonIDFK IS NULL";
		return PersonCollection::executeQuery($sql);
	}
	public static function fromDatabaseGroupOwners($groupID){
      $sql = "SELECT s.* FROM wv_staffstudentgrouplink gl";
    $sql .= " INNER JOIN wv_person s ON s.VchPersonIDPK = gl.VchPersonIDFK";
    $sql .= " WHERE gl.IntGroupID = ".$groupID;
  	return PersonCollection::executeQuery($sql);
  }
	public static function fromDatabaseGroupStudents($groupID){
		$sql = "SELECT s.* FROM wv_personstudentgrouplink sl";
		$sql .= " INNER JOIN wv_person s ON s.VchPersonIDPK = sl.VchPersonIDFK";
		$sql .= " WHERE sl.IntGroupIDFK = ".$groupID;
		return PersonCollection::executeQuery($sql); 
	}
  
    protected static function executeQuery($sql){
      $personCollection = new PersonCollection();
      $queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
      while($row = mysql_fetch_array($queryResult))
      {
        $person = Person::fromRow($row);
        $personCollection->add($person);
      }
      return $personCollection;
    }
	
	public function getPeople(){
		return $this->people;
	}
	
	public function getPeopleCount(){
		return $this->totalPeople;
	}
	
}

?>
