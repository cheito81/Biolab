<?php
/** userClass.php
* Entity userClass
* autor  Roberto Plana
* version 2012/09
*/
require_once "BDconnect.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Review.php";

class ReviewADO implements EntityInterfaceADO {

  //----------Data base Values---------------------------------------
  private static $tableName = "review";
  private static $colNameId = "id";
  private static $colNameUserId = "userId";
  private static $colNameRate = "rate";
  private static $colNameOpinion = "opinion";
 


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
    foreach ( $res as $row)
    {
      //We get all the values an add into the array
      $entity = ReviewADO::fromResultSet( $row );

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
    $id = $res[ ReviewADO::$colNameId];
    $userId = $res[ ReviewADO::$colNameUserId ];
    $rate = $res[ ReviewADO::$colNameRate ];
    $opinion = $res[ ReviewADO::$colNameOpinion ];
    $userEmail = /*$res[ ReviewADO::$colNameUserEmail ]*/ "prueba@prueba.com";

    //Object construction
    $entity = new Review();
    $entity->setId($id);
    $entity->setUserId($userId);
    $entity->setRate($rate);
    $entity->setOpinion($opinion);
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
      error_log("Error executing query in ReviewADO: " . $e->getMessage() . " ");
      die();
    }

    //Run the query
    $res = $conn->execution($cons, $vector);

    return ReviewADO::fromResultSetList( $res );
  }

  /**
  * findById()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findById( $review ) {
    $cons = "select * from `".ReviewADO::$tableName."` where ".ReviewADO::$colNameId." = ?";
    $arrayValues = [$review->getId()];

    return ReviewADO::findByQuery( $cons, $arrayValues );
  }



  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAll() {
    $cons = "select * from `".ReviewADO::$tableName."`";
    return ReviewADO::findByQuery( $cons, [] );
  }



  /**
  * findLikeReviewWeight()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikeReviewWeight( $review ) {
    $cons = "select * from `".ReviewADO::$tableName."` where ".ReviewADO::$colNameRate." like ?";
    $arrayValues = ["%".$review->getReviewWeight()."%"];

    return ReviewADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * create()
  * insert a new row into the database
  */
  public function create($review) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in create in ReviewADO: " . $e->getMessage() . " ");
      die();
    }

    $cons="insert into ".ReviewADO::$tableName." (`userId`,`rate`,`opinion`,`userEmail`) values (?, ?, ?, ?)" ;
    $arrayValues= [$review->getReviewFormula(),$review->getReviewWeight(), $review->getReviewSimilarity1(), $review->getReviewSimilarity2()];

    $id = $conn->executionInsert($cons, $arrayValues);

    $review->setId($id);

    return $review->getId();
  }

  /**
  * delete()
  * it deletes a row from the database
  */
  public function delete($review) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in delete in ReviewADO: " . $e->getMessage() . " ");
      die();
    }


    $cons="delete from `".ReviewADO::$tableName."` where ".ReviewADO::$colNameId." = ?";
    $arrayValues= [$review->getId()];

    $conn->execution($cons, $arrayValues);
  }


  /**
  * update()
  * it updates a row of the database
  */
  public function update($review) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      print "Error connecting database: " . $e->getMessage() . " ";
      die();
    }

    $cons="update `".ReviewADO::$tableName."` set ".ReviewADO::$colNameUserId." = ?,".
    ReviewADO::$colNameRate." = ?, ".ReviewADO::$colNameOpinion." = ? where ".ReviewADO::$colNameId." = ?";
    $arrayValues= [$review->getUserId(), $review->getRate(), $review->getOpinion(), $review->getId()];

    $conn->execution($cons, $arrayValues);

  }
}
?>