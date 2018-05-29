<?php
require_once "EntityInterface.php";
class Molecule implements EntityInterface, JsonSerializable{
    //put your molecular_species here
    private $molecule_chembl_id;
    private $full_molformula;
    private $full_mwt;
    private $molecular_species;
    private $canonical_smiles;
    private $qed_weighted;
    private $pref_name;
    private $structure_type;
  

    function __construct() {
    }

    public function getMolecule_chembl_id() { return $this->molecule_chembl_id; }
    public function getFull_molformula() {return $this->full_molformula;}
    public function getFull_mwt() {return $this->full_mwt;}
    public function getMolecular_species() {return $this->molecular_species;}

    public function getCanonical_smiles() { return $this->canonical_smiles; }
    public function getQed_weighted() {return $this->qed_weighted;}
    public function getPref_name() {return $this->pref_name;}
    public function getStructure_type() {return $this->structure_type;}
   

    public function setMolecule_chembl_id($molecule_chembl_id) {$this->molecule_chembl_id = $molecule_chembl_id;}

    public function setFull_molformula($full_molformula) {
        $this->full_molformula = $full_molformula;
    }

    public function setFull_mwt($full_mwt) {
        $this->full_mwt = $full_mwt;
    }

    public function setMolecular_species($molecular_species) {
        $this->molecular_species = $molecular_species;
    }

    public function setCanonical_smiles($canonical_smiles) {
        $this->canonical_smiles = $canonical_smiles;
    }

    public function setQed_weighted($qed_weighted) {
        $this->qed_weighted = $qed_weighted;
    }

    public function setPref_name($pref_name) {
        $this->pref_name = $pref_name;
    }

    public function setStructure_type($structure_type) {
        $this->structure_type = $structure_type;
    }

  

    public function jsonSerialize(){
        $data = array();
        $data["molecule_chembl_id"] = $this->molecule_chembl_id;
        $data["full_molformula"] = $this->full_molformula;
        $data["full_mwt"] = $this->full_mwt;
        $data["molecular_species"] = $this->molecular_species;
        $data["canonical_smiles"] = $this->canonical_smiles;
        $data["qed_weighted"] = $this->qed_weighted;
        $data["pref_name"] = $this->pref_name;
        $data["structure_type"] = $this->structure_type;
  
        return $data;
    }

    public function setAll($molecule_chembl_id,$full_molformula,$full_mwt,$molecular_species,$canonical_smiles,$qed_weighted,$pref_name,$structure_type){
        $this->setMolecule_chembl_id($molecule_chembl_id);
        $this->setFull_molformula($full_molformula);
        $this->setFull_mwt($full_mwt);
        $this->setMolecular_species($molecular_species);
        $this->setCanonical_smiles($canonical_smiles);
        $this->setQed_weighted($qed_weighted);
        $this->setPref_name($pref_name);
        $this->setStructure_type($structure_type);

    }

}
