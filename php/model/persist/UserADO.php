<?php
/** userClass.php
 * Entity userClass
 * autor
 * version 2012/09
 */
require_once "BDconnect.php";
require_once "EntityInterfaceADO.php";
require_once "../model/User.php";

class UserADO implements EntityInterfaceADO {

    //----------Data base Values---------------------------------------
    private static $tableName = "users";
    private static $colNameId = "id";
    private static $colNameName = "name";
    private static $colNameSurname1 = "surname1";
    private static $colNameNick = "nick";
    private static $colNamePassword = "password";
    private static $colNameUserType = "userType";
    private static $colNameAddress = "address";
    private static $colNameCity = "city";
    private static $colNameState = "state";
    private static $colNameTelephone = "telephone";
    private static $colNameMail = "mail";
    private static $colNameBirthDate = "birthDate";
    private static $colNameEntryDate = "entryDate";
    private static $colNameDropOutDate = "dropOutDate";
    private static $colNameActive = "active";
    private static $colNameImage = "image";

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
			$entity = UserADO::fromResultSet( $row );

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
		$id = $res[ UserADO::$colNameId];
        $name = $res[ UserADO::$colNameName ];
        $surname1 = $res[ UserADO::$colNameSurname1 ];
        $nick = $res[ UserADO::$colNameNick ];
        $password = $res[ UserADO::$colNamePassword ];
        $userType = $res[ UserADO::$colNameUserType ];
        $address = $res[ UserADO::$colNameAddress ];
        $city = $res[ UserADO::$colNameCity];
        $state = $res[ UserADO::$colNameState ];
        $telephone = $res[ UserADO::$colNameTelephone ];
        $mail = $res[ UserADO::$colNameMail ];
        $birthDate = $res[ UserADO::$colNameBirthDate ];
        $entryDate = $res[ UserADO::$colNameEntryDate ];
        $dropOutDate = $res[ UserADO::$colNameDropOutDate ];
        $active = $res[ UserADO::$colNameActive ];
        $image = $res[ UserADO::$colNameImage ];

       	//Object construction
       	$entity = new UserClass();
		$entity->setId($id);
		$entity->setName($name);
		$entity->setSurname1($surname1);
		$entity->setNick($nick);
		$entity->setPassword($password);
        $entity->setUserType($userType);
		$entity->setAddress($address);
        $entity->setCity($city);
        $entity->setState($state);
		$entity->setTelephone($telephone);
		$entity->setMail($mail);
		$entity->setBirthDate($birthDate);
		$entity->setEntryDate($entryDate);
		$entity->setDropOutDate($dropOutDate);
		$entity->setActive($active);
		$entity->setImage($image);

		return $entity;
    }

    /**
	 * findByQuery()
	 * It runs a particular query and returns the result
	 * @param cons query to run
	 * @return objects collection
    */
    public static function findByQuery( $cons, $vector ) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			echo "Error executing query.";
			error_log("Error executing query in UserADO: " . $e->getMessage() . " ");
			die();
		}

		$res = $conn->execution($cons, $vector);

		return UserADO::fromResultSetList( $res );
    }

    /**
	 * findById()
	 * It runs a query and returns an object array
	 * @param id
	 * @return object with the query results
    */
    public static function findById( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameId." = ?";
		$arrayValues = [$user->getId()];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	 * findlikeName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeName( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameName." like ?";
		$arrayValues = ["%".$user->getName()."%"];

		return UserADO::findByQuery($cons,$arrayValues);
    }



    /**
	* findByName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByName( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameName." = ?";
		$arrayValues = [$user->getName()];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	* findByNick()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByNick( $user ) {
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = ?";
		$arrayValues = [$user->getNick()];

		return UserADO::findByQuery($cons,$arrayValues);
    }

    /**
	* findByNickAndPass()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByNickAndPass( $user ) {
		//$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = \"".$user->getNick()."\" and ".UserADO::$colNamePassword." = \"".$user->getPassword()."\"";
		$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = ? and ".UserADO::$colNamePassword." = ?";
		$arrayValues = [$user->getNick(),$user->getPassword()];

		return UserADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findAll()
	 * It runs a query and returns an object array
	 * @param none
	 * @return object with the query results
    */
    public static function findAll( ) {
    	$cons = "select * from `".UserADO::$tableName."`";
		$arrayValues = [];

		return UserADO::findByQuery( $cons, $arrayValues );
    }


    /**
	 * create()
	 * insert a new row into the database
    */
    public function create($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="insert into ".UserADO::$tableName." (`name`,`surname1`,`nick`,`password`, `userType`,`address`, `city`, `state`,`telephone`,`mail`,`birthDate`,`entryDate`,`dropOutDate`,`active`,`image`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$arrayValues= [$user->getName(),$user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getUserType(),$user->getAddress(), $user->getCity(), $user->getState(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage()];

		$id = $conn->executionInsert($cons, $arrayValues);

		$user->setId($id);

	    return $user->getId();
	}

    /**
	 * delete()
	 * it deletes a row from the database
    */
    public function delete($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}


		$cons="delete from `".UserADO::$tableName."` where ".UserADO::$colNameId." = ?";
		$arrayValues= [$user->getId()];

		$conn->execution($cons, $arrayValues);
    }


    /**
	 * update()
	 * it updates a row of the database
    */
	 public function update($user) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="update `".UserADO::$tableName."` set ".UserADO::$colNameName." = ?, ".UserADO::$colNameSurname1." = ?, ".UserADO::$colNameNick." = ?, ".UserADO::$colNamePassword." = ?, ".UserADO::$colNameAddress." = ?, ".UserADO::$colNameTelephone." = ?, ".UserADO::$colNameMail." = ?, ".UserADO::$colNameBirthDate." = ?, ".UserADO::$colNameEntryDate." = ?, ".UserADO::$colNameDropOutDate." = ?, ".UserADO::$colNameActive." = ?, ".UserADO::$colNameImage." = ? where ".UserADO::$colNameId." = ?" ;
		$arrayValues= [$user->getName(),$user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage(),$user->getId()];

		$conn->execution($cons, $arrayValues);

    }
}
?>
