var module = angular.module('UrlRunner', []);

module.controller('Job', function ($http) {
    var self = this;
    var jobs = [];
    function ajaxError(err){
        console.error('ajax error',err);
    }
    $http.get('http://api.urlrunner.com/api/account/1/job').success(
        function (data) {
            jobs = data;
        }).error(ajaxError);
})
;