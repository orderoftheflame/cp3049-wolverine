<?php
class ProjectCollection{
	protected $projects = array();
	private $totalProjects = 0;
	
	//Adds project to collection
	public function add($value) {
		$this->projects[$this->totalProjects++] = $value;
	}
	
	public static function fromDatabase()
	{  
		$sql = "SELECT * FROM tblProjects";
		return ProjectCollection::executeQuery($sql);
	}
	
    public static function fromDatabaseSearch($keywords)
	{  
		$sql = "SELECT * FROM tblProjects WHERE vchTitle LIKE '%".$keywords."%' OR vchDetails LIKE '".$keywords."'";
		return ProjectCollection::executeQuery($sql);
	}
	
	public static function fromDatabaseAuthor($author)
	{  
		$sql = "SELECT * FROM tblProjects WHERE vchAuthor = '".$author."' ";
		return ProjectCollection::executeQuery($sql);
	}
	
    protected static function executeQuery($sql){
      $projectCollection = new ProjectCollection();
      $queryResult = mysql_query($sql) or die('Error: '.mysql_error ());
      while($row = mysql_fetch_array($queryResult))
      {
        $project = Project::fromRow($row);
        $projectCollection->add($project);
      }
      return $projectCollection;
    }
	
	public function getProjects(){
		return $this->projects;
	}
	
	public function getProjectCount(){
		return $this->totalProjects;
	}
	
}

?>