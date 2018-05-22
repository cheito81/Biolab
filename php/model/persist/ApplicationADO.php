<?php
/** userClass.php
* Entity userClass
* autor
* version 2012/09
*/
require_once "BDconnect.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Application.php";

class ApplicationADO implements EntityInterfaceADO {

  //----------Data base Values---------------------------------------
  private static $tableName = "application";
  private static $colNameId = "id";
  private static $colNameUserId = "userId";
  private static $colNamePosition = "position";
  private static $colNameStartDate = "startDate";
  private static $colNameUrl = "url";
  private static $colNameSalary = "salary";
  private static $colNameHobbies = "hobbies";
  private static $colNameRelocate = "relocate";
  private static $colNameReasons = "reasons";


  //---Databese management section-----------------------
  /**
  * fromResultSetList()
  * this function runs a query and returns an array with all the result transformed into an object
  * @param res query to execute
  * @return objects collection
  */
  public static function fromResultSetList( $res ) {
    $entityList = array();
    $i=0;
    //while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
    foreach ( $res as $row)  {
      //We get all the values an add into the array
      $entity = ApplicationADO::fromResultSet( $row );
      $entityList[$i]= $entity;
      $i++;
    }
    return $entityList;
  }

  /**
  * fromResultSet()
  * the query result is transformed into an object
  * @param res ResultSet del qual obtenir dades
  * @return object
  */
  public static function fromResultSet( $res ) {
    //We get all the values form the query
    $id = $res[ ApplicationADO::$colNameId];
    $userId = $res[ ApplicationADO::$colNameUserId ];
    $position = $res[ ApplicationADO::$colNamePosition ];
    $startDate = $res[ ApplicationADO::$colNameStartDate ];
    $url = $res[ ApplicationADO::$colNameUrl ];
    $salary = $res[ ApplicationADO::$colNameSalary ];
    $hobbies = $res[ ApplicationADO::$colNameHobbies ];
    $relocate = $res[ ApplicationADO::$colNameRelocate ];
    $reasons = $res[ ApplicationADO::$colNameReasons];

    //Object construction
    $entity = new Application();
    $entity->setId($id);
    $entity->setUserId($userId);
    $entity->setPosition($position);
    $entity->setStartDate($startDate);
    $entity->setUrl($url);
    $entity->setSalary($salary);
    $entity->setHobbies($hobbies);
    $entity->setRelocate($relocate);
    $entity->setReasons($reasons);
    return $entity;
  }

  /**
  * findByQuery()
  * It runs a particular query and returns the result
  * @param cons query to run
  * @return objects collection
  */
  public static function findByQuery( $cons, $vector ) {
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error executing query.";
      error_log("Error executing query in ApplicationADO: " . $e->getMessage() . " ");
      die();
    }
    //Run the query
    $res = $conn->execution($cons, $vector);
    return ApplicationADO::fromResultSetList( $res );
  }

  /**
  * findById()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findById( $application ) {
    $cons = "select * from `".ApplicationADO::$tableName."` where ".ApplicationADO::$colNameId." = ?";
    $arrayValues = [$application->getId()];
    return ApplicationADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAll() {
    $cons = "select * from `".ApplicationADO::$tableName."`";
    return ApplicationADO::findByQuery( $cons, [] );
  }

  /**
  * findLikePosition()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikePosition( $application ) {
    $cons = "select * from `".ApplicationADO::$tableName."` where ".ApplicationADO::$colNamePosition." like ?";
    $arrayValues = ["%".$application->getPosition()."%"];
    return ApplicationADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * create()
  * insert a new row into the database
  */
  public function create($application) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in create in ApplicationADO: " . $e->getMessage() . " ");
      die();
    }
    $cons="insert into ".ApplicationADO::$tableName." (`userId`,`position`,`startDate`,`url`, `salary`, `hobbies`, `relocate`, `reasons`) values (?, ?, ?, ?, ?, ?, ?, ?)" ;
    $arrayValues= [$application->getUserId(),$application->getPosition(), $application->getStartDate(), $application->getUrl(), $application->getSalary(), $application->getHobbies(), $application->getRelocate(),$application->getReasons()];
    $id = $conn->executionInsert($cons, $arrayValues);
    $application->setId($id);
    return $application->getId();
  }

  /**
  * delete()
  * it deletes a row from the database
  */
  public function delete($application) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in delete in ApplicationADO: " . $e->getMessage() . " ");
      die();
    }
    $cons="delete from `".ApplicationADO::$tableName."` where ".ApplicationADO::$colNameId." = ?";
    $arrayValues= [$application->getId()];
    $conn->execution($cons, $arrayValues);
  }

  /**
  * update()
  * it updates a row of the database
  */
  public function update($application) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      print "Error connecting database: " . $e->getMessage() . " ";
      die();
    }
    $cons="update `".
    ApplicationADO::$tableName."` set ".
    ApplicationADO::$colNameUserId." = ?,".
    ApplicationADO::$colNamePosition." = ?, ".
    ApplicationADO::$colNameStartDate." = ?, ".
    ApplicationADO::$colNameUrl.
    ApplicationADO::$colNameSalary.
    ApplicationADO::$colNameHobbies.
    ApplicationADO::$colNameRelocate.
    ApplicationADO::$colNameReasons.
    " = ? where ".
    ApplicationADO::$colNameId." = ?";
    $arrayValues= [$application->getUserId(), $application->getPosition(), $application->getStartDate(), $application->getUrl(), $application->getSalary(), $application->getHobbies(), $application->getRelocate(), $application->getReasons(),$application->getId()];
    $conn->execution($cons, $arrayValues);
  }
}
?>
