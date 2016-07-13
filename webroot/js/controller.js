angular.module('BlankApp', ['ngMaterial','md.data.table'])
  .controller('AppCtrl', function ($scope, $timeout, $mdSidenav,$mdDialog, $log,$http,$q) {
    //$scope.toggleLeft = buildDelayedToggler('left');
    $scope.toggleLeft = buildToggler('sidenav-left');
    
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
        $scope.selected = {};
        $scope.isAllSelected = false;
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
        if($scope.selected.length == 1){
           $http({
              method: 'GET',
              url: 'produtos/view/'+$scope.selected[0]
            }).then(function(response) {
                $scope.add = response.data.produto;  
            });
            
        }
        $scope.add = {'id_status':true};
        $mdDialog.show({
          templateUrl: 'produtos/form',
          parent: angular.element(document.body),
          clickOutsideToClose:true,
          fullscreen: true,
          scope: $scope.$new()
          
        });
    };
    
    $scope.save = function(i){
      if(!i){
          $mdDialog.hide();
      } else {
        var action = $scope.add.cd_produto ? 'edit/' + $scope.add.cd_produto : 'add';
        $http({
              method: 'POST',
              url: 'produtos/'+ action,
              data : $scope.add
            }).then(function(response) {
              $mdDialog.hide();
              all();
            }, function(response) {
                $mdDialog.hide();
            });
        }
    };
    
    $scope.delete = function(ev){
        var text = $scope.selected.length > 1 ? 'Deseja realmente excluir os produtos?' : 'Deseja realmente excluir o produto?';
        var confirm = $mdDialog.confirm()
            .title('Alerta')
            .textContent(text)
            .ariaLabel('Alerta de exclusão')
            .targetEvent(ev)
            .ok('Sim')
            .cancel('Não');
        $mdDialog.show(confirm).then(function() {
            $http({
              method: 'POST',
              url: 'produtos/delete',
              data : JSON.stringify($scope.selected)
            }).then(function(response) {
              all();
            });

        }, function() {

        });
        
    };
    
  })
  .controller('MenuCtrl', function ($scope, $mdSidenav) {
    $scope.close = function () {
      $mdSidenav('left').close();
    };
  })
  ;