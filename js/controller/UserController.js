/**
 * @name: User controller
 * @author: Jose Gimenez
 * @version: 3.1
 * @description: controll all user functions
 * @date: 17/05/2017
 */
//Angular code
(function() {
  angular.module('infoTechApp').controller("UserController", ['$http', '$scope', '$window', '$cookies', 'accessService', 'userConnected', '$filter', function($http, $scope, $window, $cookies, accessService, userConnected,$filter) {
    //scope variables
    $scope.userOption = 0;
     //Pagination variables
        $scope.pageSize = 4;
        $scope.currentPage = 1;
    //$scope.userType;
    $scope.user = new User();
    if (typeof(Storage) == "undefined") {
      alert("Your browser is not compatible with sessions, upgrade your browser");
    } else {
      if (sessionStorage.length > 0) {
        var objAux = JSON.parse(sessionStorage.getItem("userConnected"));
        if (!isNaN(objAux.id)) {
          $scope.user.construct(objAux.id,
                                objAux.name,
                                objAux.surname1,
                                objAux.nick,
                                objAux.password,
                                objAux.userType,
                                objAux.mail,
                                objAux.entryDate,
                                objAux.image);
        }
      }
    }

    //$scope.userType = $scope.user.getUserType();
    $scope.usersArray = new Array();
    $scope.passwordValid = true;

    $scope.nickValid = true;
    $scope.userImage;
    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];
    $scope.newUser = new User();
    $scope.passControl;

    $scope.dateOptions = {
      dateDisabled: "",
      formatYear: 'yyyy',
      maxDate: new Date(),
      minDate: "",
      startingDay: 1
    };

    $scope.birthDate = {
      opened: false
    };

    $scope.openBirthDate = function() {
      $scope.birthDate.opened = true;
    };

    //Methods
    /**
     * @name: userManagement
     * @author: Jose Gimenez
     * @version: 3.1
     * @description: manage users from a data base. It comunicates with php using ajax
     * 							Actually it only allow to entry a new user
     * @date: 17/05/2017
     * @return none
     */
    this.userManagement = function() {
      switch ($scope.userOption) {
        //User entry: index.html
        case 1:
          var imageFile = $("#imageUser")[0].files[0];

          var imagesArrayToSend = new FormData();
          imagesArrayToSend.append('images[]', imageFile);
          //imagesArrayToSend['images[]']

          $http({
            method: 'POST',
            url: 'php/controller/MainController.php?controllerType=2&action=10010&jsonData=' + $scope.newUser.getNick(),
            headers: {
              'Content-Type': undefined
            },
            data: imagesArrayToSend,
            transformRequest: function(data, headersGetterFunction) {
              return data;
            }
          }).success(function(outPutData) {
            if (outPutData[0] === true) {
              //File uploaded
              //$scope.user.setId(null);

              //$scope.newUser.setActive(1);
              $scope.newUser.setImage(outPutData[1][0]);
              $scope.newUser = angular.copy($scope.newUser);

              //Server conenction to verify user's data
              var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 0,
                action: 10010,
                jsonData: JSON.stringify($scope.newUser)

              });

              promise.then(function(outPutData) {
                if (outPutData[0] === true) {
                  alert("User inserted correctly");
                  $window.location.href = 'index.html';
                  this.resetForm(); // reset form
                } else {
                  if (angular.isArray(outPutData[1])) {
                    alert(outPutData[1]);
                  } else {
                    alert("There has been an error in the server, try later (1)");
                  }
                }
              });

            } else {
              if (angular.isArray(outPutData[1])) {
                showErrors(outPutData[1]);
              } else {
                alert("There has been an error in the server, try later (2)");
              }
            }
          });
          break;

        case 2:
          break;
        default:
          alert("There has been an error, try later");
          console.log("user action not correcte: " + $scope.userOption);
          break;
      }
    };

    /**
        * @name: loadUsers
        * @author: Jose Gimenez
        * @version: 3.1
        * @description: load all users existing in a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.loadUsers = function () {

            $scope.usersArray = [];

            $scope.filteredData = [];
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 0
                , action: 10040
                , jsonData: JSON.stringify("")
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                  console.log(outPutData);
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var user = new User();
                        user.construct(outPutData[1][i].id,
                                      outPutData[1][i].name,
                                      outPutData[1][i].surname1,
                                      outPutData[1][i].nick,
                                      outPutData[1][i].password,
                                      outPutData[1][i].userType,
                                      outPutData[1][i].mail,
                                      outPutData[1][i].entryDate,
                                      outPutData[1][i].image);
                        $scope.usersArray.push(user);
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
        };

        /**
    @name checkPassword
    @description Validates Dni 
    @version 1.0
    @date 17/04/2017
    @author Jose Gimenez
    @param Dni of user
    @return true if valid false otherwise.
    */
    this.checkPassword=function(){
      $scope.passwordValid = true;
      $("#password2").addClass("ng-invalid");
      $("#password2").removeClass("ng-valid");

      if ($scope.passControl != undefined) {
        
        if ($scope.newUser.password === $scope.passControl) {
          $("#password2").addClass("ng-valid");
          $("#password2").removeClass("ng-invalid");
          $scope.passwordValid = false;
          
        }
      }
      
    };

    /**
    @name ResetForm
    @description reset form and style 
    @version 1.0
    @date 24/04/2018
    @author Jose Gimenez & marvin Hernandez
    @param none
    @return none.
    */
    this.resetForm=function(){
      $scope.newUser = null;
      $scope.passControl = null;
      $scope.userManagement.$setPristine();
      
    };


     /**
        * @name: modifyUser
        * @author: Jose Gimenez
        * @version: 3.1
        * @description: modify a user existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.modifyUser = function (index) {

            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 0
                , action: 10020
                , jsonData: JSON.stringify([angular.copy($scope.usersArray[index])])
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    alert("User modified correctly");
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
        * @name: removeUser
        * @author: Jose Gimenez - Marvin Hernandez
        * @version: 3.1
        * @description: remove a user existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.removeUser = function (user) {
            var userFound = new User();
            var usersArray = [];

            var rm = confirm("sure you want to delete the user?");
            if (rm == true) {
              user = angular.copy(user);
              usersArray.push(user);

              console.log(usersArray);
              var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                  controllerType: 0
                  , action: 10060
                  , jsonData: JSON.stringify(usersArray)
              });

              promise.then(function (outPutData) {
                  if (outPutData[0] === true) {
                      var pos = $scope.usersArray.indexOf(user);
                      $scope.usersArray.splice(pos, 1);
                      alert("User deleted correctly");
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

    /**
     * @name: connection
     * @author: Jose Gimenez
     * @version: 3.1
     * @description: it allows to establishes a session variable to controll session user
     * @date: 17/05/2017
     * @return none
     */
    this.connection = function() {
      //copy
      $scope.user = angular.copy($scope.user);
      //Server conenction to verify user's data
      var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
        controllerType: 0,
        action: 10000,
        jsonData: JSON.stringify($scope.user)
      });
      promise.then(function(outPutData) {
        if (outPutData[0] === true) {
          if (typeof(Storage) !== "undefined") {
            sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
            window.open("mainWindow.html", "_self");
          } else {
            alert("Your browser is not compatible with this application, upgrade it plase!");
          }
        } else {
          if (angular.isArray(outPutData[1])) {
                alert(outPutData[1]);
          } else {
                alert("There has been an error in the server, try later");
          }
        }
      });
    };

    /**
     * @name: setFile
     * @author: Jose Gimenez
     * @version: 3.1
     * @description: it allows to load a new file into user file variable.
     * @date: 17/05/2017
     * @return none
     */
    $scope.setFile = function(element) {
      $scope.currentFile = element.files[0];
      var reader = new FileReader();

      reader.onload = function(event) {
        $scope.userImage = event.target.result;
        $scope.$apply();
      };

      // when the file is read it triggers the onload event above.
      reader.readAsDataURL(element.files[0]);
    };
  }]);

  /**
   * @name: userRegister
   * @author: Jose Gimenez
   * @version: 3.1
   * @description: that directove controlls "user-data-management" template
   * @date: 17/05/2017
   * @return none
   */
  angular.module('infoTechApp').directive("userRegister", function() {
    return {
      restrict: 'E',
      templateUrl: "view/templates/user-register.html",
      controller: function() {},
      controllerAs: 'userRegister'
    };
  });

  /**
   * @name: userManagament
   * @author: Marvin Hernandez
   * @version: 3.1
   * @description: that directove controlls "user-management" template
   * @date: 17/05/2017
   * @return none
   */
  angular.module('infoTechApp').directive("userManagament", function() {
    return {
      restrict: 'E',
      templateUrl: "view/templates/user-managament.html",
      controller: function() {},
      controllerAs: 'userManagament'
    };
  });

})();
