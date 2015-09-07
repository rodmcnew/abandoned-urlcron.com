var module = angular.module('UrlRunner', ['ui.bootstrap.datetimepicker']);

module.controller('Job', function ($http, $scope) {
    var self = this;
    var jobs = [];

    function ajaxError(err) {
        console.error('ajax error', err);
    }

    $scope.job = {nextRunTime: 'Thu Jan 01 2015 01:00:00 GMT-0600 (CST)'};
    //$http.get('http://api.urlrunner.com/api/account/1/job').success(
    //    function (data) {
    //        jobs = data;
    //    }).error(ajaxError);
})
;