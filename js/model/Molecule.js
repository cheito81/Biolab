/**
*  @name Molecule
*  @author Marvin Hernandez
*  @version: 1.1
*  @date: 18/05/2018
*  @description Defines the property of the product object and contains the methods used to construct the object and access it.
*/
function Molecule (){
  //Properties
  this.molecule_chembl_id;
  this.full_molformula;
  this.full_mwt;
  this.molecular_species;
  this.canonical_smiles;
  this.molecule_type;
  this.pref_name;
  this.structure_type;


  //Methods
  
  //Constructor
  this.construct = function (molecule_chembl_id, full_molformula, full_mwt, molecular_species,canonical_smiles,molecule_type,pref_name,structure_type)  {
    this.molecule_chembl_id = molecule_chembl_id;
    this.full_molformula=full_molformula;
    this.full_mwt = full_mwt;
    this.molecular_species = molecular_species;
    this.canonical_smiles = canonical_smiles;
    this.molecule_type=molecule_type;
    this.pref_name = pref_name;
    this.structure_type = structure_type;
  };

  // ==== getters==== 

  this.getMolecule_chembl_id = function ()  {
    return this.molecule_chembl_id;
  };

  this.getFull_molformula = function ()  {
    return this.full_molformula;
  };

  this.getFull_mwt = function ()  {
    return this.full_mwt;
  };

  this.getMolecular_species = function ()  {
    return this.molecular_species;
  };

  this.getCanonical_smiles = function ()  {
    return this.canonical_smiles;
  };

  this.getMolecule_type = function ()  {
    return this.molecule_type;
  };

  this.getPref_name = function ()  {
    return this.pref_name;
  };

  this.getStructure_type = function ()  {
    return this.structure_type;
  };

  // ==== setters==== 

  this.setMolecule_chembl_id = function (molecule_chembl_id)  {
    this.molecule_chembl_id = molecule_chembl_id;
  };

  this.setFull_molformula = function (full_molformula)  {
    this.full_molformula = full_molformula;
  };

  this.setFull_mwt = function (full_mwt)  {
    this.full_mwt = full_mwt;
  };

  this.setMolecular_species = function (molecular_species)  {
    this.molecular_species = molecular_species;
  };

  this.setCanonical_smiles = function (canonical_smiles)  {
    this.canonical_smiles = canonical_smiles;
  };

  this.setMolecule_type = function (molecule_type)  {
    this.molecule_type = molecule_type;
  };

  this.setPref_name = function (pref_name)  {
    this.pref_name = pref_name;
  };

  this.setStructure_type = function (structure_type)  {
    this.structure_type = structure_type;
  };


}
