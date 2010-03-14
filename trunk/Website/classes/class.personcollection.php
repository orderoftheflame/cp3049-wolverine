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