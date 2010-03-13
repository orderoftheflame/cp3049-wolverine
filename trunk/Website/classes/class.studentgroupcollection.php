<?php
class StudentGroupCollection{
	protected $groups = array();
	private $totalGroups = 0;
	
	//Adds to collection
	public function add($value) {
		$this->groups[$this->totalGroups++] = $value;
	}
	
	public static function fromDatabase()
	{  
		$sql = "SELECT * FROM wv_studentgroups ORDER BY VchGroupTitle";
		return StudentGroupCollection::executeQuery($sql);
	}
	
    protected static function executeQuery($sql){
      $studentGroupCollection = new StudentGroupCollection();
      $queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
      while($row = mysql_fetch_array($queryResult))
      {
        $group = StudentGroup::fromRow($row);
        $studentGroupCollection->add($group);
      }
      return $studentGroupCollection;
    }
	
	public function getGroups(){
		return $this->groups;
	}
	
	public function getGroupCount(){
		return $this->totalGroups;
	}
	
}

?>