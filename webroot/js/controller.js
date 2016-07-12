angular.module('BlankApp', ['ngMaterial','md.data.table'])
  .controller('AppCtrl', function ($scope, $timeout, $mdSidenav,$mdDialog, $log,$http,$q) {
    $scope.toggleLeft = buildDelayedToggler('left');
    $scope.toggleRight = buildToggler('sidenav-left');
    $scope.isOpenRight = function(){
      return $mdSidenav('sidenav-left').isOpen();
    };
    /**
     * Supplies a function that will continue to operate until the
     * time is up.
     */
    function debounce(func, wait, context) {
      var timer;
      return function debounced() {
        var context = $scope,
            args = Array.prototype.slice.call(arguments);
        $timeout.cancel(timer);
        timer = $timeout(function() {
          timer = undefined;
          func.apply(context, args);
        }, wait || 10);
      };
    }
    /**
     * Build handler to open/close a SideNav; when animation finishes
     * report completion in console
     */
    function buildDelayedToggler(navID) {
      return debounce(function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }, 200);
    }
    function buildToggler(navID) {
      return function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }
    };
    var all = function(){
        var deferred = $q.defer();
        $scope.promise = deferred.promise;
        $http({
            method: 'GET',
            url: 'produtos/all'
        }).then(function(response) {
            deferred.resolve();
            $scope.produtos = response.data.produtos;
        }, function(response) {

        });
    };
    all();
    
    $scope.toggleAll = function() {
        var toggleStatus = $scope.isAllSelected;
        angular.forEach($scope.produtos, function(itm){ itm.selected = toggleStatus; });
        qtSel();
    };
    $scope.optionToggled = function(){
        $scope.isAllSelected = $scope.produtos.every(function(itm){
            return itm.selected; 
        });
        qtSel();
    };
    
    var qtSel = function(){
      $scope.selected = [];
      for(var i in $scope.produtos){
          if($scope.produtos[i].selected){
              $scope.selected.push($scope.produtos[i].cd_produto) ;
          }
      }
    };
    
    $scope.showModal = function(){
        $mdDialog.show({
          templateUrl: 'produtos/form',
          parent: angular.element(document.body),
          clickOutsideToClose:true,
          fullscreen: true
        })
        .then(function(answer) {
          $scope.status = 'You said the information was "' + answer + '".';
        }, function() {
          $scope.status = 'You cancelled the dialog.';
        });
        
    };
    
  })
  .controller('MenuCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      $mdSidenav('left').close()
        .then(function () {
          $log.debug("close LEFT is done");
        });
    };
  })
  .controller('RightCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      $mdSidenav('sidenav-left').close()
        .then(function () {
          $log.debug("close RIGHT is done");
        });
    };
  });