<?php
/**
* toDoClass class
* it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Application.php";
require_once "../model/persist/ApplicationADO.php";


class ApplicationController implements ControllerInterface {
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

	public function doAction()	{
		$outPutData = array();
		switch ( $this->getAction() ) {
			case 10000:
			$outPutData = $this->entryApplication();
			break;
			case 10010:
			$outPutData = $this->loadApplications();
			break;
			case 10020:
			$outPutData = $this->modifyApplication();
			break;
			case 10030:
			$outPutData = $this->deleteApplication();
			break;
			default:
			$errors = array();
			$outPutData[0]=false;
			$errors[]="Sorry, there has been an error. Try later";
			$outPutData[]=$errors;
			error_log("Action not correct in ApplicationController, value: ".$this->getAction());
			break;
		}
		return $outPutData;
	}



	private function entryApplication()	{
		$applicationObj = json_decode(stripslashes($this->getJsonData()));
		$application = new Application();

		$application->setAll(null, $applicationObj->userId, $applicationObj->position, $applicationObj->startDate, $applicationObj->url, $applicationObj->salary, $applicationObj->hobbies, $applicationObj->relocate, $applicationObj->reasons);
		$outPutData = array();

		$outPutData[]=true;
		$application->setId(ApplicationADO::create($application));

		//the senetnce returns de id's of the applications inserted
		$outPutData[]= array($application->getAll());
		return $outPutData;
	}

	private function loadApplications()	{
		$outPutData = array();
		$applicationsArray = ApplicationADO::findAll();
		if(count($applicationsArray) == 0)	{
			$outPutData[]= false;
			$errors = array();
			$errors[]="No applications found in the database";
			$outPutData[] = $errors;
		}
		else {
			$outPutData[]= true;
			$applicationsToLocal = array();
			foreach ($applicationsArray as $application) {
				$applicationsToLocal[]=$application->getAll();
			}
			$outPutData[] = $applicationsToLocal;
		}
		return $outPutData;
	}

	private function modifyApplication() {
		//Films modification
		$applicationsArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[]= true;
		foreach($applicationsArray as $applicationObj) {
			$application = new Application();
			$application->setAll($applicationObj->id, $applicationObj->userId, $applicationObj->position, $applicationObj->startDate, $applicationObj->url, $applicationObj->salary, $applicationObj->hobbies, $applicationObj->relocate, $applicationObj->reasons);
			ApplicationADO::update($application);
		}
		return $outPutData;
	}

	private function deleteApplication()	{
		//Films modification
		$applicationsArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[]= true;
		foreach($applicationsArray as $applicationObj)	{
			$application = new Application();
			$application->setAll($applicationObj->userId, $applicationObj->position, $applicationObj->startDate, $applicationObj->url, $applicationObj->salary, $applicationObj->hobbies, $applicationObj->relocate, $applicationObj->reasons);
			ApplicationADO::delete($application);
		}
		return $outPutData;
	}
}
?>
