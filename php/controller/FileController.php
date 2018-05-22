<?php
require_once "ControllerInterface.php";

class FileController implements ControllerInterface  {
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

    public function doAction() {
		$newFileNames = array();
		$outPutData = array();

		switch ($this->getAction())	{
			case "10000":
				//This option is to upload new films images to the server
				//$_FILES contains all the file to upload
				//The program returns an array with the new file's name that ust be inserted into the database
				$i=0;
				foreach($_FILES['images']['error'] as $key => $error){
					if($error == UPLOAD_ERR_OK){
						$name = $_FILES['images']['name'][$key];
						$fileNameParts = explode(".", $name);
						$nameWithoutExtension = $fileNameParts[0];
						$extension = end($fileNameParts);
						$newFileName = "film_".$i.time().".".$extension;
						move_uploaded_file($_FILES['images']['tmp_name'][$key], '../../images/filmsImages/' . $newFileName);

						$newFileNames[]='images/filmsImages/'.$newFileName;
						$i++;
					}
				}
				$outPutData[]=true;
				$outPutData[]=$newFileNames;
				break;
			case "10010":
				//This option is to upload users images to the server
				//$_FILES contains all the file to upload
				//The program returns an array with the new file's name that ust be inserted into the database
				$outPutData[]=true;
				foreach($_FILES['images']['error'] as $key => $error){
					if($error == UPLOAD_ERR_OK){
						$name = $_FILES['images']['name'][$key];
						$fileNameParts = explode(".", $name);
						$nameWithoutExtension = $fileNameParts[0];
						$extension = end($fileNameParts);
						$newFileName = $this->getJsonData().".".$extension;
						move_uploaded_file($_FILES['images']['tmp_name'][$key], '../../images/usersImages/' . $newFileName);
						$newFileNames[]='images/usersImages/'.$newFileName;
					}
					else	{
						$outPutData[0]=false;
					}
				}
				$outPutData[]=$newFileNames;
				break;
			case "10020":
				//This option is to remove files from the server
				//$_REQUEST["JSONData"] contains all the file's names to remove
				$filesToDeleteArray = json_decode(stripslashes($this->getJsonData()));
				foreach($filesToDeleteArray as $filename){
					if(file_exists('../../'.$filename)) unlink('../../'.$filename);
				}
				$outPutData[]=true;
				break;
			default:
				$errors = array();
				$outPutData[0]=false;
				$errors[]="Sorry, there has been an error. Try later";
				$outPutData[]=$errors;
				echo "Action not correct in FileController, value: ".$this->getAction();
				break;
		}

		return 	$outPutData;
	}
}
?>
