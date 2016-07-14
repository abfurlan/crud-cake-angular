angular.module('BlankApp', ['ngMaterial','md.data.table'])
  .controller('AppCtrl', function ($scope, $timeout, $mdSidenav,$mdDialog, $log,$http,$q) {
    /*
     * Para controlar o menu lateral
     */
    $scope.toggleLeft = buildToggler('sidenav-left');
    function buildToggler(navID) {
      return function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      };
    };
    /*
     * Função para selecionar todos os produtos por ajax
     * e passa o objeto para view
     */
    var all = function(){
        $scope.selected = {}; // nenhum produto selecionado
        $scope.isAllSelected = false; // check master não seleciona
        /*
         * promise da barra de progresso da table
         */
        var deferred = $q.defer();
        $scope.promise = deferred.promise;
        /*
         * Requisição ajax para selecionar todos os produtos
         */
        $http({
            method: 'GET',
            url: 'produtos/all'
        }).then(function(response) {
            deferred.resolve();
            $scope.produtos = response.data.produtos;
        }, function(response) {

        });
    };
    
    all(); // chama a função para selecionar os produtos
    
    /*
     * Função para armazenar os checkbox selecionados
     */
    var qtSel = function(){
      $scope.selected = [];
      for(var i in $scope.produtos){
          if($scope.produtos[i].selected){
              $scope.selected.push($scope.produtos[i].cd_produto) ;
          }
      }
    };
    
    //Função para controlar o checkbox master da table
    $scope.toggleAll = function() {
        var toggleStatus = $scope.isAllSelected;
        angular.forEach($scope.produtos, function(itm){ itm.selected = toggleStatus; });
        qtSel();
    };
    //Função para controlar os checkbox de cada produto
    $scope.optionToggled = function(){
        $scope.isAllSelected = $scope.produtos.every(function(itm){
            return itm.selected; 
        });
        qtSel();
    };
    
    
    /*
     * Exibe o modal com o formulário de cadastro e
     * ou edição de produtos
     */
    $scope.showModal = function(e){
        /*
         * Se hover somente um checkbox selecionado, busca o produto
         * no banco de dados e coloca no form para edição
         */
        if($scope.selected.length == 1 && e === 'edit'){
           $http({
              method: 'GET',
              url: 'produtos/view/'+$scope.selected[0]
            }).then(function(response) {
                $scope.add = response.data.produto;  
            });
            
        }
        $scope.add = {'id_status':true};
        /*
         * Exibe o modal buscando o template no Controller produtos/form
         */
        $mdDialog.show({
          templateUrl: 'produtos/form',
          parent: angular.element(document.body),
          clickOutsideToClose:true,
          fullscreen: true,
          scope: $scope.$new()
        });
    };
    /*
     * Função para salvar o produto
     */
    $scope.save = function(i){
      if(!i){ // Se clicar no botão cancelar do modal somente o oculta
          $mdDialog.hide();
      } else {
        /*
         * Monta a url de acordo com a ação, se clicou no botão editar haverá 
         * um produto selecionado portanto a url da requisição será
         * produtos/edit/id_do_produto
         * Se clicou no botão novo, a url será edit/produtos/add
         */
        var action = $scope.add.cd_produto ? 'edit/' + $scope.add.cd_produto : 'add';
        /*
         * Envia os dados por ajax
         */
        $http({
              method: 'POST',
              url: 'produtos/'+ action,
              data : $scope.add
            }).then(function(response) {
              $mdDialog.hide();//oculta o modal
              all();//recarrega os produtos na table
            }, function(response) {
                $mdDialog.hide();
            });
        }
    };
    /*
     * Função para excluir um ou mais produtos
     */
    $scope.status = function(id,status){
        /*
         * Exibe o modal de confirmação
         */
        var text = status ? 'desativar' :  'ativar';
        var confirm = $mdDialog.confirm()
            .title('Alerta')
            .textContent('Deseja realmente alterar o '+text+' o produto?')
            .ariaLabel('Alerta de exclusão')
            //.targetEvent(ev)
            .ok('Sim')
            .cancel('Não');
        //se confirmou envia para o Controller e exclui
        $mdDialog.show(confirm).then(function() {
            $http({
              method: 'POST',
              url: 'produtos/status/'+id+'/'+status,
              data : JSON.stringify($scope.selected)
            }).then(function(response) {
              all();
            });

        }, function() {

        });
        
    };
    
    $scope.delete = function(ev){
        /*
         * Exibe o modal de confirmação
         */
        var text = $scope.selected.length > 1 ? 'Deseja realmente excluir os produtos?' : 'Deseja realmente excluir o produto?';
        var confirm = $mdDialog.confirm()
            .title('Alerta')
            .textContent(text)
            .ariaLabel('Alerta de exclusão')
            .targetEvent(ev)
            .ok('Sim')
            .cancel('Não');
    
        //se confirmou envia para o Controller e exclui
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
    
    //Atualiza a tabela
    $scope.refresh = function(){ all()};
    
  })
  .controller('MenuCtrl', function ($scope, $mdSidenav) {
    $scope.close = function () {
      $mdSidenav('left').close();
    };
  })
  ;