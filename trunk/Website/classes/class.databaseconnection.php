<?php

class DatabaseConnection
{
  private static $db = null;
  protected static $connection;
  public static function get()
  {
    if ( $db == null )
      $db = new DatabaseConnection();
    return $db;
  }
  private function __construct()
  {
    $connection = mysql_connect("pdb2.awardspace.com","noirenex_cp3049","kellogs");
    if (!$connection)
    {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('noirenex_cp3049', $connection);
  }
  
  public static function Close(){
  if ($connection){
  mysql_close($connection);
  $connection = null;
  }
  
  }
  
}


?>