<?php
/** Application.php
* Entity Application
* autor
* version 2012/09
*/
require_once "EntityInterface.php";

class Application implements EntityInterface {

  private $id;
	private $userID;
	private $position;
	private $startDate;
	private $url;
	private $salary;
	private $hobbies;
	private $relocate;
	private $reasons;

  function __construct() {
  }

  public function getId() {return $this->id;}
  public function getUserId() {return $this->userId;}
  public function getPosition() {return $this->position;}
  public function getStartDate() {return $this->startDate;}
  public function getUrl() {return $this->url;}
  public function getSalary() {return $this->salary;}
  public function getHobbies() {return $this->hobbies;}
  public function getRelocate() {return $this->relocate;}
  public function getReasons() {return $this->reasons;}

  public function setId($id) {$this->id = $id;}
  public function setUserId($userId) {$this->userId = $userId;}
  public function setPosition($position) {$this->position = $position;}
  public function setStartDate($startDate) {$this->startDate = $startDate;}
  public function setUrl($url) {$this->url = $url;}
  public function setSalary($salary) {$this->salary = $salary;}
  public function setHobbies($hobbies) {$this->hobbies = $hobbies;}
  public function setRelocate($relocate) {$this->relocate = $relocate;}
  public function setReasons($reasons) {$this->reasons = $reasons;}

  public function getAll() {
    $data = array();
    $data["id"] = $this->id;
    $data["userId"] = $this->userId;
    $data["position"] = $this->position;
    $data["startDate"] = $this->startDate;
    $data["url"] = $this->url;
    $data["salary"] = $this->salary;
    $data["hobbies"] = $this->hobbies;
    $data["relocate"] = $this->relocate;
    $data["reasons"] = $this->reasons;
    return $data;
  }

  public function setAll($id=null, $userId=null, $position=null, $startDate=null, $url=null, $salary=null, $hobbies=null, $relocate=null, $reasons=null) {
    $this->setId($id);
    $this->setUserId($userId);
    $this->setPosition($position);
    $this->setStartDate($startDate);
    $this->setUrl($url);
    $this->setSalary($salary);
    $this->setHobbies($hobbies);
    $this->setRelocate($relocate);
    $this->setReasons($reasons);
  }
}
?>
