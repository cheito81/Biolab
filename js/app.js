// jQuery code
$(document).ready(function () {

});

(function(){

  var infoTechApp = angular.module('infoTechApp', ['ng-currency', 'ui.bootstrap', 'ngCookies','datatables']);

  infoTechApp.factory('userConnected', function(){
      // I know this doesn't work, but what will?
      var user = new User();
      return user;
  });

  infoTechApp.directive('validFile',function(){
      return {
          require:'ngModel',
          link:function(scope,el,attrs,ctrl){
              ctrl.$setValidity('validFile', el.val() != '');
              //change event is fired when file is selected
              el.bind('change',function(){
                  ctrl.$setValidity('validFile', el.val() != '');
                  scope.$apply(function(){
                      ctrl.$setViewValue(el.val());
                      ctrl.$render();
                  });
              });
          }
      };
  });

  infoTechApp.factory('accessService', function($http, $log, $q) {
  	return {
  		getData: function(url, async, method, params, data) {
  			var deferred = $q.defer();
  			$http({
  				url: url,
  				method: method,
  				asyn: async,
  				params: params,
  				data: data
  			})
  			.success(function(response, status, headers, config)  {
  				deferred.resolve(response);
  			})
  			.error(function(msg, code) {
  				deferred.reject(msg);
  				$log.error(msg, code);
  				alert("There has been an error in the server, try later");
  			});

  			return deferred.promise;
  		}
  	}
  });
})();
