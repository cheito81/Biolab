//JQuery code


//Angular code
(function (){
	//Application module
	angular.module('infoTechApp').controller("StatisticsController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.showForm=0;

		this.generateBoxPlotMolecularWeight = function ()	{
			var promise = accessService.getData("../RScripts/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10000, jsonData:JSON.stringify("")});

			promise.then(function (outPutData) {
				if(outPutData[0]== true)	{
						console.log(outPutData);
						$scope.file1 = outPutData[1];
						$scope.file2 = outPutData[2];
						$scope.statistics = angular.fromJson(outPutData[3]);
				}
				else	{
					if(angular.isArray(outPutData[1]))		{
						alert(outPutData[1]);
					}
					else {alert("There has been an error in the server, try later");}
				}
			});
		}
	}]);
})();


//Own code
