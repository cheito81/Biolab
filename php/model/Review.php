<?php
require_once "EntityInterface.php";
class Review implements EntityInterface{
    //put your opinion here
    private $id;
    private $userId;
    private $rate;
    private $opinion;
  

    function __construct() {
    }

    public function getId() { return $this->id; }
    public function getUserId() {return $this->userId;}
    public function getRate() {return $this->rate;}
    public function getOpinion() {return $this->opinion;}
   

    public function setId($id) {$this->id = $id;}

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setRate($rate) {
        $this->rate = $rate;
    }

    public function setOpinion($opinion) {
        $this->opinion = $opinion;
    }

  

    public function getAll(){
        $data = array();
        $data["id"] = $this->id;
        $data["userId"] = $this->userId;
        $data["rate"] = $this->rate;
        $data["opinion"] = $this->opinion;
  
        return $data;
    }

    public function setAll($id,$userId,$rate,$opinion){
        $this->setId($id);
        $this->setUserId($userId);
        $this->setRate($rate);
        $this->setOpinion($opinion);

    }

}
