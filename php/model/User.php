<?php
/** userClass.php
* Entity userClass
* autor  Roberto Plana
* version 2012/09
*/
 
require_once "EntityInterface.php";
class UserClass implements EntityInterface {
  private $id;
  private $name;
  private $surname1;  
  private $nick;
  private $password;
  private $mail;
  private $entryDate;
  private $image;
  private $userType;

  //----------Data base Values---------------------------------------
  private static $tableName = "users";
  private static $colNameId = "id";
  private static $colNameName = "name";
  private static $colNameSurname1 = "surname1";
  private static $colNameNick = "nick";
  private static $colNamePassword = "password";
  private static $colNameUserType = "userType";
  private static $colNameMail = "mail";
  private static $colNameEntryDate = "entryDate";
  private static $colNameImage = "image";

  function __construct() {
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getSurname1() {
    return $this->surname1;
  }

  public function getNick() {
    return $this->nick;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getUserType() {
    return $this->userType;
  }
  public function getMail() {
    return $this->mail;
  }

  public function getEntryDate() {
    return $this->entryDate;
  }

  public function getImage() {
    return $this->image;
  }




  public function setId($id) {
    $this->id = $id;
  }
  public function setName($name) {
    $this->name = $name;
  }

  public function setSurname1($surname1) {
    $this->surname1 = $surname1;
  }

  public function setNick($nick) {
    $this->nick = $nick;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function setUserType($userType) {
    $this->userType = $userType;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }
  public function setEntryDate($entryDate) {
    $this->entryDate = $entryDate;
  }
  public function setImage($image) {
    $this->image = $image;
  }

  public function getAll() {
    $data = array();
    $data["id"] = $this->id;
    $data["name"] = $this->name;
    $data["surname1"] = $this->surname1;
    $data["nick"] = $this->nick;
    $data["password"] = $this->password;
    $data["userType"] = $this->userType;
    $data["mail"] = $this->mail;
    $data["entryDate"] = $this->entryDate;
    $data["image"] = $this->image;
    return $data;
  }

  public function setAll($id, $name, $surname1, $nick, $password,$userType, $mail, $entryDate, $image) {
    $this->setId($id);
    $this->setName($name);
    $this->setSurname1($surname1);
    $this->setNick($nick);
    $this->setPassword($password);
    $this->setUserType($userType);
    $this->setMail($mail);
    $this->setEntryDate($entryDate);
    $this->setImage($image);

  }
}
?>
