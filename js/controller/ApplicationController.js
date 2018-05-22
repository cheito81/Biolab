/**
* @name: AplicationController
* @author: Jose Gimenez & Hector Garcia
* @version: 3.1
* @description: contolls al application functions
* @date: 17/05/2017
*/
//JQuery code
//Angular code
(function (){
	//Application module
	angular.module('infoTechApp').controller("ApplicationController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.application = new Aplication();
		$scope.application.setUrl(null);
		$scope.application.setReasons(null);
		$scope.hobbiesArray = new Array("Reading","Cinema","Dancing","Sport","Traveling");
		$scope.positionArray = new Array("CEO","Human resources director","Secretery");

		$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
		$scope.format = $scope.formats[0];
		$scope.dateOptions = {
			dateDisabled: "",
			formatYear: 'yyyy',
			maxDate: "",
			minDate: new Date(),
			startingDay: 1
		};

		$scope.startDate = {
			opened: false
		};

		/**
		* @name: openStartDate
		* @author: Jose Gimenez & Hector Garcia
		* @version: 3.1
		* @description: open datepicker calendar
		* @date: 17/05/2017
		* @return: none
		*/
		$scope.openStartDate = function() {
			$scope.startDate.opened = true;
		};

		/**
		* @name: hobbiesMng
		* @author: Jose Gimenez & Hector Garcia
		* @version: 3.1
		* @description: controlls hobbies array, add or remove hobbies from it
		* @date: 17/05/2017
		* @return: none
		*/
		this.hobbiesMng = function (indexChecked)	{
			if($("#Hobbies"+indexChecked).is(":checked")) {
				$scope.application.addHobbies($scope.hobbiesArray[indexChecked]);
			}
			else {
				$scope.application.removeHobbies($scope.hobbiesArray[indexChecked]);
			}
		};

		/**
		* @name: entryApplication
		* @author: Jose Gimenez & Hector Garcia
		* @version: 3.1
		* @description: modify a aplication in a data base. It comunicates with php using ajax
		* @date: 17/05/2017
		* @return: none
		*/
		this.entryApplication = function () {
			//We will send the array to the server in order to execute an
			$scope.application.setUserId($scope.user.getId());
			$scope.application.hobbiesToString();
			//$scope.application.setStartDate("1987-05-03");
			//$scope.application.getHobbies();
			$scope.application = angular.copy($scope.application);
			var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:1,action:10000,jsonData:JSON.stringify($scope.application)});

			promise.then(function (outPutData) {
				//alert($scope.application.toString());
				if(outPutData[0]=== true) {
					//Applications have been inerted correctly
					alert("Applications inserted correctly");
					$scope.entryApplicationsForm.$setPristine();

					$window.location.href = 'mainWindow.html';
					//$scope.showForm=1;
					//$scope.userAction=1;
				}
				else {
					if(angular.isArray(outPutData[1]))	{
						alert(outPutData[1]);
					}
					else {
						alert("There has been an error in the server, try later");
					}
				}
			});
		};
	}]);


	/**
	* @name: infoTechApp
	* @author: Jose Gimenez & Hector Garcia
	* @version: 3.1
	* @description: that directove controlls "aplication-entry-form" template
	* @date: 17/05/2017
	*/
	angular.module('infoTechApp').directive("applicationEntryForm", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/application-entry-form.html",
			controller:function(){

			},
			controllerAs: 'applicationEntryForm'
		};
	});

	/**
	* @name: infoTechApp
	* @author: Jose Gimenez & Hector Garcia
	* @version: 3.1
	* @description: that directove controlls datepicker format date
	* @date: 17/05/2017
	* @return: none
	*/
	angular.module('infoTechApp').directive('myDate', function(dateFilter) {
		return {
			restrict: 'EAC',
			require: '?ngModel',
			link: function(scope, element, attrs, ngModel) {
				ngModel.$parsers.push(function(viewValue) {
					return dateFilter(viewValue,'yyyy-MM-dd');
				});
			}
		};
	});
})();
