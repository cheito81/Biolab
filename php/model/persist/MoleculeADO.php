<?php
/** userClass.php
* Entity userClass
* autor  Roberto Plana
* version 2012/09
*/
require_once "BDconnect.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Molecule.php";

class MoleculeADO implements EntityInterfaceADO {

  //----------Data base Values---------------------------------------
  private static $tableName = "molecule";
  private static $colNameId = "molecule_chembl_id";
  private static $colNameFull_molformula = "full_molformula";
  private static $colNameFull_mwt = "full_mwt";
  private static $colNameMolecular_species = "molecular_species";
 


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
      $entity = MoleculeADO::fromResultSet( $row );

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
    $molecule_chembl_id = $res[ MoleculeADO::$colNameId];
    $full_molformula = $res[ MoleculeADO::$colNameFull_molformula ];
    $full_mwt = $res[ MoleculeADO::$colNameFull_mwt ];
    $molecular_species = $res[ MoleculeADO::$colNameMolecular_species ];
    $userEmail = /*$res[ MoleculeADO::$colNameUserEmail ]*/ "prueba@prueba.com";

    //Object construction
    $entity = new Molecule();
    $entity->setId($molecule_chembl_id);
    $entity->setFull_molformula($full_molformula);
    $entity->setFull_mwt($full_mwt);
    $entity->setMolecular_species($molecular_species);
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
      error_log("Error executing query in MoleculeADO: " . $e->getMessage() . " ");
      die();
    }

    //Run the query
    $res = $conn->execution($cons, $vector);

    return MoleculeADO::fromResultSetList( $res );
  }

  /**
  * findById()
  * It runs a query and returns an object array
  * @param molecule_chembl_id
  * @return object with the query results
  */
  public static function findById( $review ) {
    $cons = "select * from `".MoleculeADO::$tableName."` where ".MoleculeADO::$colNameId." = ?";
    $arrayValues = [$review->getId()];

    return MoleculeADO::findByQuery( $cons, $arrayValues );
  }



  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAll() {
    $cons = "select * from `".MoleculeADO::$tableName."`";
    return MoleculeADO::findByQuery( $cons, [] );
  }
  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAllSimilary($smile) {
    return file_get_contents('https://www.ebi.ac.uk/chembl/api/data/similarity/'.$smile.'/80');
  }



  /**
  * findLikeMoleculeWeight()
  * It runs a query and returns an object array
  * @param molecule_chembl_id
  * @return object with the query results
  */
  public static function findLikeMoleculeWeight( $review ) {
    $cons = "select * from `".MoleculeADO::$tableName."` where ".MoleculeADO::$colNameFull_mwt." like ?";
    $arrayValues = ["%".$review->getMoleculeWeight()."%"];

    return MoleculeADO::findByQuery( $cons, $arrayValues );
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
      error_log("Error in create in MoleculeADO: " . $e->getMessage() . " ");
      die();
    }

    $cons="insert into ".MoleculeADO::$tableName." (`full_molformula`,`full_mwt`,`molecular_species`,`userEmail`) values (?, ?, ?, ?)" ;
    $arrayValues= [$review->getMoleculeFormula(),$review->getMoleculeWeight(), $review->getMoleculeSimilarity1(), $review->getMoleculeSimilarity2()];

    $molecule_chembl_id = $conn->executionInsert($cons, $arrayValues);

    $review->setId($molecule_chembl_id);

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
      error_log("Error in delete in MoleculeADO: " . $e->getMessage() . " ");
      die();
    }


    $cons="delete from `".MoleculeADO::$tableName."` where ".MoleculeADO::$colNameId." = ?";
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

    $cons="update `".MoleculeADO::$tableName."` set ".MoleculeADO::$colNameFull_molformula." = ?,".
    MoleculeADO::$colNameFull_mwt." = ?, ".MoleculeADO::$colNameMolecular_species." = ? where ".MoleculeADO::$colNameId." = ?";
    $arrayValues= [$review->getFull_molformula(), $review->getFull_mwt(), $review->getMolecular_species(), $review->getId()];

    $conn->execution($cons, $arrayValues);

  }
}
?>