<?php

require_once '../model/User.php';
require_once '../model/Molecule.php';

/**
 * ItemFormValidation
 * Management of item's form
 * @author Jse Gimenez, Marvin Hernandez
 */
class ItemFormValidation {

 /**
     * check if the fields are empty
     * @Param $userObj user object of json
     * @return null if there is no empty field, string if there is any empty field
    */
public static function userEmptyfields ($userObj){
    $empties =null;

    if ($userObj->name=="") {
        $empties = "empty name";
    }
    if ($userObj->surname1=="") {
        $empties .= "empty surname1";
    }
    if ($userObj->nick=="") {
        $empties .= "empty nick";
    }
    if ($userObj->password=="") {
        $empties .= "empty password";
    }
    if ($userObj->userType=="") {
        $empties .= "empty userType";
    }
    if ($userObj->mail=="") {
        $empties .= "empty mail";
    }
    if ($userObj->image=="") {
        $empties .= "empty image";
    }
    return $empties;

}

 /**
     * check if the fields are empty
     * @Param $userObj user object of json
     * @return null if there is no empty field, string if there is any empty field
    */
public static function moleculeEmptyfields ($moleculeObj){
    $empties =null;

    if ($moleculeObj->molecule_chembl_id=="") {
        $empties = "empty molecule_chembl_id\n";
    }
    if ($moleculeObj->full_molformula=="") {
        $empties .= "empty full_molformula\n";
    }
    if ($moleculeObj->full_mwt=="") {
        $empties .= "empty full_mwt\n";
    }
    if ($moleculeObj->molecular_species=="") {
        $empties .= "empty molecular_species\n";
    }
    if ($moleculeObj->canonical_smiles=="") {
        $empties .= "empty canonical_smiles\n";
    }
    if ($moleculeObj->pref_name=="") {
        $empties .= "empty pref_name\n";
    }
    if ($moleculeObj->structure_type=="") {
        $empties .= "empty structure_type\n";
    }
    return $empties;
}

/**
 *
 * Valida un email usando filter_var y comprobar las DNS. 
 *  
 * @param    string  $str la dirección a validar
 * @return   boolean true si es correcto o false en caso contrario
 *
 */
function is_valid_email($str)
{
  
  $matches = null;
  return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
}
 

}
