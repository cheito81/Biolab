/**
* @name: ReviewController
* @author: Jose Gimenez & Hector Garcia
* @version: 3.1
* @description: Controlls all review functions
* @date: 17/05/2017
*/
//JQuery code
//Angular code
(function () {
    //Application module
    angular.module('infoTechApp').controller("ReviewController", ['$http', '$scope', '$window', '$cookies', 'accessService', '$filter', function ($http, $scope, $window, $cookies, accessService, $filter) {
        //scope variables
        $scope.reviewsArray = new Array();
        $scope.usersArray = new Array();
        $scope.reviewsModArray = new Array();
        var review = new Review();
        $scope.userEmails = new Array();
        //Pagination variables
        $scope.pageSize = 4;
        $scope.currentPage = 1;

        /**
        * @name: modifyReview
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: modify a review existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.modifyReview = function (index) {

            $scope.filteredData[index].setUserId($scope.filteredData[index].userId.getId());

            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 3
                , action: 10020
                , jsonData: JSON.stringify([angular.copy($scope.filteredData[index])])
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    alert("Review modified correctly");
                    for (var i = 0; i < $scope.reviewsArray.length; i++) {
                        for (var j = 0; j < $scope.usersArray.length; j++) {
                            if ($scope.usersArray[j].id == $scope.reviewsArray[i].userId) {
                                $scope.reviewsArray[i].userId = $scope.usersArray[j];
                                $scope.userEmails.push($scope.usersArray[i].mail);
                            }
                        }
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
        * @name: removeReview
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: remove a review existing ni a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        this.removeReview = function (review) {
            var reviewFound = new Review();
            var reviewsArray = [];
            $scope.reviewsModArray = angular.copy($scope.reviewsModArray);
            $scope.filteredData = angular.copy($scope.filteredData);

            review = angular.copy(review);
            reviewsArray.push(review);
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 3
                , action: 10030
                , jsonData: JSON.stringify(reviewsArray)
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    //Reviews have been inerted correctly
                    $scope.reviewsModArray.splice($scope.reviewsModArray.indexOf(review), 1);
                    $scope.filteredData.splice($scope.filteredData.indexOf(review), 1);
                    alert("Review deleted correctly");
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
        * @name: modifyReview
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: load all reviews existing in a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        $scope.loadReviews = function () {
            $scope.reviewsModArray = [];
            $scope.filteredData = [];
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 3
                , action: 10010
                , jsonData: JSON.stringify("")
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var review = new Review();
                        review.construct(outPutData[1][i].id, outPutData[1][i].userId, outPutData[1][i].rate, outPutData[1][i].opinion);
                        $scope.reviewsModArray.push(review);
                        $scope.reviewsArray.push(review);
                    }

                    $scope.filteredData = $scope.reviewsModArray;
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
        * @name: modifyReview
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: allows to search in pagination usin reviews fields. It filter by opinion and rate.
        * @date: 17/05/2017
        * @return: none
        */
        $scope.$watch("RateSearch+OpinionSearch", function () {
            $scope.filteredData = $filter('filter')($scope.reviewsModArray, {
                rate: $scope.RateSearch
                , opinion: $scope.OpinionSearch
            });
        });

        /**
        * @name: loadUsers
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: load all users existing in a data base. It comunicates with php using ajax
        * @date: 17/05/2017
        * @return: none
        */
        $scope.loadUsers = function () {
            $scope.reviewsModArray = [];
            $scope.filteredData = [];
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {
                controllerType: 0
                , action: 10040
                , jsonData: JSON.stringify("")
            });
            promise.then(function (outPutData) {
                if (outPutData[0] === true) {
                    for (var i = 0; i < outPutData[1].length; i++) {
                        var user = new User();
                        user.construct(outPutData[1][i].id, outPutData[1][i].name, outPutData[1][i].surname1, outPutData[1][i].nick, outPutData[1][i].password, outPutData[1][i].userType, outPutData[1][i].address, outPutData[1][i].city, outPutData[1][i].state, outPutData[1][i].telephone, outPutData[1][i].mail, outPutData[1][i].birthDate, outPutData[1][i].entryDate, outPutData[1][i].dropOutDate, outPutData[1][i].active, outPutData[1][i].image);
                        $scope.usersArray.push(user);
                    }
                    /*
                    for (var i = 0; i < $scope.reviewsArray.length; i++) {
                        for (var j = 0; j < $scope.usersArray.length; j++) {
                            if ($scope.usersArray[j].id == $scope.reviewsArray[i].userId) {
                                $scope.reviewsArray[i].userId = $scope.usersArray[j];
                                $scope.userEmails.push($scope.usersArray[i].mail);
                            }
                        }
                    }*/
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
        * @name: loadData
        * @author: Jose Gimenez & Hector Garcia
        * @version: 3.1
        * @description: load al reviews and user into diferent arrays
        * @date: 17/05/2017
        * @return: none
        */
        this.loadData = function () {
            $scope.loadReviews();
            $scope.loadUsers();
        };
    }]);

    /**
    * @name: reviewModForm
    * @author: Jose Gimenez & Hector Garcia
    * @version: 3.1
    * @description: entry a rev
    * @date: 17/05/2017
    * @return: none
    */
    angular.module('infoTechApp').directive("reviewModForm", function () {
        return {
            restrict: 'E'
            , templateUrl: "view/templates/review-mod-form.html"
            , controller: function () {}
            , controllerAs: 'reviewModForm'
        };
    });
})();
//Own code
