/**
 * @name: MoleculeController
 * @author: Marvin Hernandez Lopez
 * @version: 3.1
 * @description: controll all molecules functions
 * @date: 18/05/2018
 */
//Angular code
(function() {
  angular.module('infoTechApp').controller("MoleculeController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function($http, $scope, $window, $cookies, accessService, $filter) {
    
    //scope variables
    //$scope.moleculeOption = 0;

    $scope.molecule = new Molecule();

    $scope.moleculesArray = new Array();    //Array from my database.
    $scope.moleculesArrayApi = new Array(); //Array from API (similarity).
    $scope.moleculesArrayAux = new Array(); //array for view molecules in the table.
     
    //$scope.format = $scope.formats[0];
    
    $scope.newMolecule = new Molecule();

    
        /**
        * @name: loadMolecules
        * @author: Marvin Hernandez
        * @version: 1.0
        * @description: load all molecules existing in a data base. It comunicates with php using ajax
        * @date: 22/05/2018
        * @return: none
        */
        this.loadMolecules = function () {

            $scope.moleculesArray = [];
            $scope.moleculesArrayAux = [];

            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 4
                , action: 10010
                , jsonData: JSON.stringify("")
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                  //console.log(outPutData);
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var molecule = new Molecule();
                        molecule.construct(outPutData[1][i].molecule_chembl_id,
                                            outPutData[1][i].full_molformula,
                                            outPutData[1][i].full_mwt,
                                            outPutData[1][i].molecular_species,
                                            outPutData[1][i].canonical_smiles,
                                            outPutData[1][i].moleculeType,
                                            outPutData[1][i].pref_name,
                                            outPutData[1][i].structure_type);
                        $scope.moleculesArray.push(molecule);
                    }
                    
                }
                else {
                    if (angular.isArray(outPutData[1])) {
                        alert(outPutData[1]);
                    }
                    else {
                        alert("There has been an error in the server, try later");
                    }
                }
                $scope.moleculesArrayAux = $scope.moleculesArray; //for view

            });
        };


    /**
        * @name: similaryMolecules
        * @author: Marvin Heranndez
        * @version: 3.1
        * @description: load all molecules existing in a data base. It comunicates with php using ajax
        * @date: 17/05/2018
        * @return: none
        */
        this.similaryMolecules = function () {

            $scope.moleculesArrayApi = [];

            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 4
                , action: 10040
                , jsonData: "C[C@H](NCc1ccc(OCc2cccc(F)c2)cc1)C(=O)N"
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                  console.log(outPutData);
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var molecule = new Molecule();
                        molecule.construct(outPutData[1][i].molecule_chembl_id, outPutData[1][i].full_molformula, outPutData[1][i].full_mwt, outPutData[1][i].molecular_species, outPutData[1][i].canonical_smiles, outPutData[1][i].molecule_type, outPutData[1][i].pref_name, outPutData[1][i].structure_type);
                        $scope.moleculesArrayApi.push(molecule);
                    }
                }
                else {
                    if (angular.isArray(outPutData[1])) {
                        alert(outPutData[1]);
                    }
                    else {
                        alert("There has been an error in the server, try later");
                    }
                }
                //console.log($scope.moleculesArrayApi);
                $scope.moleculesArrayAux = $scope.moleculesArrayApi // for print in the table

            });
        };

  }]);

  /**
   * @name: MoleculeManagament
   * @author: Marvin Hernandez
   * @version: 3.1
   * @description: that directove controlls "molecule-management" template
   * @date: 17/05/2018
   * @return none
   */
  angular.module('infoTechApp').directive("moleculeManagament", function() {
    return {
      restrict: 'E',
      templateUrl: "view/templates/molecule-managament.html",
      controller: function() {},
      controllerAs: 'moleculeManagament'
    };
  });

  /**
   * @name: MoleculeEntryForm
   * @author: Marvin Hernandez
   * @version: 3.1
   * @description: that directove controlls "molecule-entry" template
   * @date: 17/05/2018
   * @return none
   */
  angular.module('infoTechApp').directive("moleculesEntry", function() {
    return {
      restrict: 'E',
      templateUrl: "view/templates/molecules-entry.html",
      controller: function() {},
      controllerAs: 'moleculesEntry'
    };
  });

})();