<?php

require_once '../model/User.php';
require_once '../model/Molecule.php';

/**
 * Description of ItemFormValidation
 * Management of item's form
 * @author Jse Gimenez
 */
class ItemFormValidation {

 
    /**
     * Description: check if the fields are empty
     * @Param $userObj user object of json
     * @return Array false in the first position if they are empty and in the second position string with the empty fields, true in the first position the fields are not empty
    */
public static function fieldsUser ($userObj){
    $outPutData = array();  

    $emptyFields = ItemFormValidation::userEmptyfields($userObj);

    if ($emptyFields!=null) {
       $outPutData[0]=false;
       $outPutData[1]=$emptyFields;
    } else {
       $outPutData[0]=true;
    }
    

    return $outPutData;

}

 /**
     * Description: check if the fields are empty
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
     * Description: check if the fields are empty
     * @Param $userObj user object of json
     * @return Array false in the first position if they are empty and in the second position string with the empty fields, true in the first position the fields are not empty
    */
public static function fieldsMolecule (){
    $outPutData = array();  

    $emptyFields = userEmptyfields($userObj);

    if ($emptyFields!=null) {
       $outPutData[0]=false;
       $outPutData[1]=$emptyFields;
    } else {
       $outPutData[0]=true;
    }
    return $outPutData;

}

 /**
     * Description: check if the fields are empty
     * @Param $userObj user object of json
     * @return null if there is no empty field, string if there is any empty field
    */
public static function moleculeEmptyfields ($userObj){
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
 

}
