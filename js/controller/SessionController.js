/**
* @name: SessionController
* @author: Marvin Hernandez - Jose Gimenez
* @version: 3.1
* @description: it controlls all session functionalities
* @date: 15/05/2018
*/
//Angular code
(function () {
    angular.module('infoTechApp').controller("SessionController", ['$http', '$scope', '$window', '$cookies', 'accessService', 'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {
        //scope variables
        $scope.user = new User();
        $scope.userAction = 0;
        $scope.userType;
        $scope.showForm = 0;
        $scope.sessionOpened = false;

        /**
        * @name: sessionControl
        * @author: Jose Gimenez & Marvin Hernandez
        * @version: 3.1
        * @description: it establishes user session
        * @date: 17/05/2018
        */
        this.sessionControl = function () {
            var promise;
            switch ($scope.userAction) {
                //Index.html is executed
            case 0:
                promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                    controllerType: 0
                    , action: 10030
                    , jsonData: JSON.stringify("")
                });
                promise.then(function (outPutData) {
                    if (outPutData[0] === true) {
                        window.open("mainWindow.html", "_self");
                    }
                    else {
                        if (!angular.isArray(outPutData[1])) {
                            alert("There has been an error in the server, try later");
                        }
                    }
                });
                break;
                //mainWindow.html is executed
            case 1:
                promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                    controllerType: 0
                    , action: 10030
                    , jsonData: JSON.stringify("")
                });
                promise.then(function (outPutData) {
                    if (outPutData[0] === true) {
                        $scope.user.construct(outPutData[1].id,
                                            outPutData[1].name,
                                            outPutData[1].surname1,
                                            outPutData[1].nick,
                                            outPutData[1].password,
                                            outPutData[1].userType,
                                            outPutData[1].mail,
                                            outPutData[1].entryDate,
                                            outPutData[1].image);
                        $scope.sessionOpened = true;
                        userConnected.user = $scope.user;
                        $scope.userType = $scope.user.getUserType();
                        var a = 1;
                    }
                    else {
                        if (angular.isArray(outPutData[1])) {
                            window.open("index.html", "_self");
                        }
                        else {
                            alert("There has been an error in the server, try later");
                        }
                    }
                });
                break;
            default:
                alert("There has been an error, try later");
                console.log("user action not correcte: " + $scope.userAction);
                break;
            }
        };

        /**
        * @name: logOut
        * @author: Jose Gimenez & Marvin Hernandez
        * @version: 3.1
        * @description: it allow user to leave session.
        * @date: 17/05/2018
        */
        this.logOut = function () {
            //Local session destroy
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 0
                , action: 10050
                , jsonData: JSON.stringify("")
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    sessionStorage.removeItem("userConnected");
                    window.open("index.html", "_self");
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
	}]);
})();
