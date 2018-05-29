/**
 * @name: MoleculeController
 * @author: Marvin Hernandez Lopez
 * @version: 3.1
 * @description: controll all molecules functions
 * @date: 18/05/2018
 */
//Angular code
(function() {
  angular.module('infoTechApp').controller("MoleculeController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function($http, $scope, $window, $cookies, accessService, $filter,$timeout,Excel) {
    
    //scope variables
    //$scope.moleculeOption = 0;

    $scope.molecule = new Molecule();

    $scope.moleculesArray = new Array();    //Array from my database.
    $scope.moleculesArrayApi = new Array(); //Array from API (similarity).
    $scope.moleculesArrayAux = new Array(); //array for view molecules in the table.
    
    $scope.newMolecule = new Molecule();
    $scope.moleculeId = "";

    $scope.moleculeOption = 0;

            $scope.exportData = function () {
                $('#moleculeShow').tableExport({ type: 'json', escape: 'false' });
            };
            
            $scope.exportToExcel=function(tableId){ // ex: '#my-table'
            var exportHref=Excel.tableToExcel(tableId,'WireWorkbenchDataExport');
            $timeout(function(){location.href=exportHref;},100); // trigger download
        }
            
             $scope.exportToPdf = function(){
        html2canvas(document.getElementById('moleculeShow'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                 pdfMake.createPdf(docDefinition).download("similariesTo"+$scope.moleculeId+".pdf");
            }
        });
     }
  

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
                controllerType: 1
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
                                            outPutData[1][i].qed_weighted,
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
                $scope.moleculesArrayAux = angular.copy($scope.moleculesArray); //for view

            });
        };



        /**
        * @name: modifyMolecule
        * @author: Jose Gimenez
        * @version: 3.1
        * @description: modify a molecule existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.modifyMolecule = function (index) {
            console.log($scope.moleculesArrayAux[index]);
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 1
                , action: 10020
                , jsonData: JSON.stringify([angular.copy($scope.moleculesArrayAux[index])])
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    alert("Molecule modified correctly");
                }
                else {
                    if (angular.isArray(outPutData[1])) {
                        alert(outPutData[1]);
                    }
                    else {
                        alert("There has been an error in the server, try later");
                    }
                }
            });
        };


    /**
    @name ResetForm
    @description reset form and style 
    @version 1.0
    @date 24/04/2018
    @author Jose Gimenez & Marvin Hernandez
    @param none
    @return none.
    */
    this.resetForm=function(){
      $scope.moleculeManagement.$setPristine();
      $scope.molecule = null;
    };


        /**
        * @name: MoleculesInsert
        * @author: Marvin Heranndez
        * @version: 3.1
        * @description: Insert object in the data base
        * @date: 23/05/2018
        * @return: none
        */
        this.moleculeInsert = function () {
          
            
              //File uploaded
              //$scope.molecule.setId(null);

              $scope.molecule = angular.copy($scope.molecule);

              //Server conenction to verify molecule's data
              console.log($scope.molecule);

              var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 1,
                action: 10000,
                jsonData: JSON.stringify($scope.molecule)

              });

              promise.then(function(outPutData) {
                if (outPutData[0] === true) {
                  alert("Molecule inserted correctly");
                  $window.location.href = 'mainWindow.html';
                } else {
                  if (angular.isArray(outPutData[1])) {
                    alert(outPutData[1]);
                  } else {
                    alert("There has been an error in the server, try later (1)");
                  }
                }
              });
          //console.log($scope.molecule.molecule_chembl_id);
        };

        /**
        * @name: removeMolecule
        * @author: Jose Gimenez - Marvin Hernandez
        * @version: 3.1
        * @description: remove a molecule existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.removeMolecule = function (index) {
            var moleculeFound = new Molecule();
            var moleculesArray = [];

            var rm = confirm("sure you want to delete the molecule?");
            if (rm == true) {
           
              var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                  controllerType: 1
                  , action: 10030
                  , jsonData: JSON.stringify([angular.copy($scope.moleculesArrayAux[index])])

              });

              promise.then(function (outPutData) {
                  if (outPutData[0] === true) {
                      
                      $scope.moleculesArrayAux.splice(index, 1);
                      console.log($scope.moleculesArrayAux);
                      $scope.moleculesArray = angular.copy($scope.moleculesArrayAux);

                      alert("Molecule deleted correctly");
                  }
                  else {
                      if (angular.isArray(outPutData[1])) {
                          alert(outPutData[1]);
                      }
                      else {
                          alert("There has been an error in the server, try later");
                      }
                  }
              });

            } else {

            }
        };

    //this.exportData = function ()


        /**
        * @name: similaryMolecules
        * @author: Marvin Heranndez
        * @version: 3.1
        * @description: load all molecules existing in a data base. It comunicates with php using ajax
        * @date: 17/05/2018
        * @return: none
        */
        this.similaryMolecules = function (index) {

            $scope.moleculesArrayApi = [];
            $scope.moleculeOption = 1;
            $smile = $scope.moleculesArrayAux[index].canonical_smiles; //smile
            $scope.moleculeId = $scope.moleculesArrayAux[index].molecule_chembl_id; //ID

            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 1
                , action: 10040
                , jsonData: $smile
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                  console.log(outPutData);
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var molecule = new Molecule();
                        molecule.construct(outPutData[1][i].molecule_chembl_id, outPutData[1][i].full_molformula, outPutData[1][i].full_mwt, outPutData[1][i].molecular_species, outPutData[1][i].canonical_smiles, outPutData[1][i].qed_weighted, outPutData[1][i].pref_name, outPutData[1][i].structure_type);
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

            });
            //$scope.showForm = 4;
            //

            
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
   * @name: MoleculeShow
   * @author: Marvin Hernandez
   * @version: 1.1
   * @description: that directove controlls "molecule-show" template
   * @date: 22/05/2018
   * @return none
   */
  angular.module('infoTechApp').directive("moleculeShow", function() {
    return {
      restrict: 'E',
      templateUrl: "view/templates/molecule-show.html",
      controller: function() {},
      controllerAs: 'moleculeShow'
    };
  });

  /**
   * @name: MoleculeEntryForm
   * @author: Marvin Hernandez
   * @version: 1.0
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


        angular.module('infoTechApp').factory('Excel',function($window){
        var uri='data:application/vnd.ms-excel;base64,',
            template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},
            format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
        return {
            tableToExcel:function(tableId,worksheetName){
                var table=$(tableId),
                    ctx={worksheet:worksheetName,table:table.html()},
                    href=uri+base64(format(template,ctx));
                return href;
            }
        };
    })