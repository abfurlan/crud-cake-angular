<md-content flex layout-padding class="height-100">
    <md-toolbar class="md-table-toolbar md-default">
        <div class="md-toolbar-tools actions">
            <md-button class="md-raised md-primary" ng-click="showModal('new')">
                <md-icon md-svg-icon="img/icons/ic_add_white_24px.svg" ></md-icon>
                Novo
            </md-button>
            <md-button class="md-raised" ng-click="showModal('edit')" ng-show="selected.length == 1">
                <md-icon md-svg-icon="img/icons/ic_mode_edit_black_24px.svg"></md-icon>
                Editar
            </md-button>
            <md-button class="md-raised md-warn" ng-click="delete()" ng-show="selected.length > 0">
                <md-icon md-svg-icon="img/icons/ic_delete_white_24px.svg"></md-icon>
                Excluir
            </md-button>
            <md-button class="md-icon-button" ng-click="refresh()">
                <md-icon md-svg-icon="img/icons/ic_refresh_black_24px.svg"></md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-table-container>
        <table md-table ngDisabled md-progress="promise">
            <thead md-head>
                <tr md-row>
                    <th md-column><input type="checkbox" ng-change="toggleAll()" ng-model="isAllSelected" /></th>
                    <th md-column>Código</th>
                    <th md-column>Descrição</th>
                    <th md-column md-numeric>Saldo</th>
                    <th md-column md-numeric>Preço</th>
                    <th md-column md-numeric>Ativo?</th>
                </tr>
            </thead>
            <tbody md-body>
                <tr md-row md-select="produto" md-select-id="name" md-auto-select ng-repeat="produto in produtos">
                    <td md-cell>
                        <input type="checkbox" name="cod"  
                               ng-model="produto.selected" ng-change="optionToggled()" />
                    </td>
                    <td md-cell>{{produto.cd_produto}}</td>
                    <td md-cell>{{produto.dc_descricao}}</td>
                    <td md-cell>{{produto.nm_saldo | number: 0}}</td>
                    <td md-cell>{{produto.vl_preco | number: 2}}</td>
                    <td md-cell> 
                        <input type="checkbox" name="status" value="{{produto.cd_produto}}" 
                               ng-click="status(produto.cd_produto,produto.id_status); $event.preventDefault();"
                               ng-checked="produto.id_status"  />
                    </td>
                </tr>
                <tr md-row>
                    <td md-cell colspan="6" ng-show="produtos.length === 0">
                        Nenhum registro encontrado
                    </td>
                </tr>
            </tbody>
        </table>
    </md-table-container>
    
    <div flex></div>
    <div flex></div>
    <div flex></div>
</md-content>