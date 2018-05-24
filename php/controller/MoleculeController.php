<?php
/**
* toDoClass class
* it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Molecule.php";
require_once "../model/persist/MoleculeADO.php";


class MoleculeController implements ControllerInterface {
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
			$outPutData = $this->entryMolecule();
			break;
			case 10010:
			$outPutData = $this->loadMolecule();
			break;
			case 10020:
			$outPutData = $this->modifyMolecule();
			break;
			case 10030:
			$outPutData = $this->deleteMolecule();
			break;
			case 10040:
			$outPutData = $this->similarMolecule();
			break;
			default:
			$errors = array();
			$outPutData[0]=false;
			$errors[]="Sorry, there has been an error. Try later";
			$outPutData[]=$errors;
			error_log("Action not correct in MoleculeController, value: ".$this->getAction());
			break;
		}
		return $outPutData;
	}

	private function entryMolecule(){	//stripslashes elimina las barras invertidas agregadas

		$moleculesArray = json_decode(stripslashes($this->getJsonData()));
		var_dump($moleculesArray);

		$idsArray = array();
		foreach ($moleculesArray as $moleculeObj) {
			$molecule = new Molecule();
			$molecule->setAll($moleculeObj->molecule_chembl_id, $moleculeObj->full_molformula, $moleculeObj->full_mwt, $moleculeObj->molecular_species, $moleculeObj->canonical_smiles, $moleculeObj->molecule_type, $moleculeObj->pref_name, $moleculeObj->structure_type);
			$molecule->setMolecule_chembl_id(MoleculeADO::create($molecule));
			$idsArray[]=$molecule->getMolecule_chembl_id();
		}
		$outPutData = array();
		$outPutData[]= true;
		//the senetnce returns de id's of the molecules inserted
		$outPutData[]= $idsArray;
		return $outPutData;
	}

	private function loadMolecule()	{
		$outPutData = array();
		$moleculesArray = MoleculeADO::findAll();
		if(count($moleculesArray) == 0)	{
			$outPutData[]= false;
			$errors = array();
			$errors[]="No molecules found in the database";
			$outPutData[] = $errors;
		}
		else {
			$outPutData[]= true;
			$moleculesToLocal = array();
			foreach ($moleculesArray as $molecule) {
				$moleculesToLocal[]=$molecule->jsonSerialize();
			}
			$outPutData[] = $moleculesToLocal;
		}
		return $outPutData;
	}
    
	private function modifyMolecule() {
		
		$moleculesArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[0]= true;
		foreach($moleculesArray as $moleculeObj) {
			$molecule = new Molecule();
			$molecule->setAll(0, $moleculeObj->molecule_chembl_id, $moleculeObj->full_molformula, $moleculeObj->full_mwt, $moleculeObj->molecular_species, $moleculeObj->canonical_smiles, $moleculeObj->molecule_type, $moleculeObj->pref_name, $moleculeObj->structure_type);
			
			MoleculeADO::update($molecule);
		}
       
		return $outPutData;
	}
	
	private function deleteMolecule() {
		
		$moleculesArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[0]= true;
		foreach($moleculesArray as $moleculeObj) {
			$molecule = new Molecule();
			$molecule->setAll($moleculeObj->id, $moleculeObj->userId, $moleculeObj->rate, $moleculeObj->opinion);
			MoleculeADO::delete($molecule);
		}
		return $outPutData;
	}


	private function similarMolecule() {
		$outPutData = array();
		$smile = "";
		//$arrayAPI = json_decode(MoleculeADO::findAllSimilary(stripslashes($this->getJsonData())));
		$smile = stripslashes($this->getJsonData());
		//echo $smile;
		$arrayAPI = json_decode(MoleculeADO::findAllSimilary(stripslashes($this->getJsonData())));
        $moleculesArrayAPI=$arrayAPI->{"molecules"};
	
		if(count($moleculesArrayAPI) == 0)	{
			$outPutData[]= false;
			$errors = array();
			$errors[]="No molecules found in the database";
			$outPutData[] = $errors;
		}
		else {

			$outPutData[0] = true;
			$outPutData[1] = [];
			$moleculesToLocal = array();
			
			foreach ($moleculesArrayAPI as $mol) {
				$molecule = new Molecule();
				
				$molecule->setAll($mol->{"molecule_chembl_id"}, $mol->{"molecule_properties"}->{"full_molformula"}, $mol->{"molecule_properties"}->{"full_mwt"}, $mol->{"molecule_properties"}->{"molecular_species"}, $mol->{"molecule_structures"}->{"canonical_smiles"},$mol->{"molecule_type"},$mol->{"pref_name"},$mol->{"structure_type"});

				array_push($outPutData[1], $molecule);
				
			}
			
			//$outPutData[] = $moleculesToLocal;

		}

		return $outPutData;
	}
}
?>