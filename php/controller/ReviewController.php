<?php
/**
* toDoClass class
* it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Review.php";
require_once "../model/persist/ReviewADO.php";


class ReviewController implements ControllerInterface {
	private $action;
	private $jsonData;

	function __construct($action, $jsonData) {
		$this->setAction($action);
		$this->setJsonData($jsonData);
	}

	public function getAction() {
		return $this->action;
	}

	public function getJsonData() {
		return $this->jsonData;
	}

	public function setAction($action) {
		$this->action = $action;
	}
	public function setJsonData($jsonData) {
		$this->jsonData = $jsonData;
	}

	public function doAction()
	{
		$outPutData = array();

		switch ( $this->getAction() )
		{
			case 10000:
			$outPutData = $this->entryReview();
			break;
			case 10010:
			$outPutData = $this->loadReview();
			break;
			case 10020:
			$outPutData = $this->modifyReview();
			break;
			case 10030:
			$outPutData = $this->deleteReview();
			break;
			default:
			$errors = array();
			$outPutData[0]=false;
			$errors[]="Sorry, there has been an error. Try later";
			$outPutData[]=$errors;
			error_log("Action not correct in ReviewController, value: ".$this->getAction());
			break;
		}
		return $outPutData;
	}

	private function entryReview()	{
		$reviewsArray = json_decode(stripslashes($this->getJsonData()));
		$idsArray = array();
		foreach ($reviewsArray as $reviewObj) {
			$review = new Review();
			$review->setAll(0, $reviewObj->reviewFormula, $reviewObj->reviewWeight, $reviewObj->reviewSimilarity1, $reviewObj->reviewSimilarity2);
			$review->setId(ReviewADO::create($review));
			$idsArray[]=$review->getId();
		}
		$outPutData = array();
		$outPutData[]= true;
		//the senetnce returns de id's of the reviews inserted
		$outPutData[]= $idsArray;
		return $outPutData;
	}

	private function loadReview()	{
		$outPutData = array();
		$reviewsArray = ReviewADO::findAll();
		if(count($reviewsArray) == 0)	{
			$outPutData[]= false;
			$errors = array();
			$errors[]="No reviews found in the database";
			$outPutData[] = $errors;
		}
		else {
			$outPutData[]= true;
			$reviewsToLocal = array();
			foreach ($reviewsArray as $review) {
				$reviewsToLocal[]=$review->getAll();
			}
			$outPutData[] = $reviewsToLocal;
		}
		return $outPutData;
	}
    
	private function modifyReview() {
		
		$reviewsArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[0]= true;
		foreach($reviewsArray as $reviewObj) {
			$review = new Review();
			$review->setAll($reviewObj->id, $reviewObj->userId, $reviewObj->rate, $reviewObj->opinion);
			ReviewADO::update($review);
		}
       
		return $outPutData;
	}

	private function deleteReview() {
		
		$reviewsArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[0]= true;
		foreach($reviewsArray as $reviewObj) {
			$review = new Review();
			$review->setAll($reviewObj->id, $reviewObj->userId, $reviewObj->rate, $reviewObj->opinion);
			ReviewADO::delete($review);
		}
		return $outPutData;
	}
}
?>