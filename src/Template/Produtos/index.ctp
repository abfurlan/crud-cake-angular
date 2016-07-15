<md-content flex layout-padding class="height-100">
    <md-card>
        <md-toolbar class="md-table-toolbar md-default">
            <div class="md-toolbar-tools actions">
                <md-button class="md-raised md-primary" ng-click="showModal('new')">
                    <md-icon md-svg-icon="img/icons/ic_add_white_24px.svg" ></md-icon>
                    <span hide-xs>Novo</span>
                </md-button>
                <md-button class="md-raised" ng-click="showModal('edit')" ng-show="selected.length == 1">
                    <md-icon md-svg-icon="img/icons/ic_mode_edit_black_24px.svg"></md-icon>
                    <span hide-xs>Editar</span>
                </md-button>
                <md-button class="md-raised md-warn" ng-click="delete()" ng-show="selected.length > 0">
                    <md-icon md-svg-icon="img/icons/ic_delete_white_24px.svg"></md-icon>
                    <span hide-xs>Excluir</span>
                </md-button>
                <div flex></div>
                <md-button class="md-icon-button" ng-click="refresh()" aria-label="Atualizar">
                    <md-icon md-svg-icon="img/icons/ic_refresh_black_24px.svg"></md-icon>
                </md-button>

            </div>
        </md-toolbar>

        <md-table-container>
            <table md-table ngDisabled md-progress="promise">
                <thead md-head md-order="query.order" md-on-reorder="logOrder">
                    <tr md-row>
                        <th md-column>
                            <input type="checkbox" ng-change="toggleAll()" ng-model="isAllSelected" />
                        </th>
                        <th md-column md-order-by="cd_produto">Código</th>
                        <th md-column md-order-by="dc_descricao">Descrição</th>
                        <th md-column md-numeric md-order-by="nm_saldo">Saldo</th>
                        <th md-column md-numeric md-order-by="vl_preco">Preço</th>
                        <th md-column md-numeric>Ativo?</th>
                    </tr>
                </thead>
                <tbody md-body>
                    <tr md-row md-select="produto" md-select-id="name" md-auto-select 
                        ng-repeat="produto in produtos |  orderBy: query.order">
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
        <md-table-pagination md-limit="query.limit" md-limit-options="limitOptions" 
            md-page="query.page" md-total="{{produtos.count}}" 
            md-page-select="options.pageSelect" 
            md-boundary-links="options.boundaryLinks" 
            md-on-paginate="logPagination"
            md-label="{page: 'Página:', rowsPerPage: 'Registros por página:', of: 'de'}">
        </md-table-pagination>
    </md-card>
    <div flex></div>
    <div flex></div>
    <div flex></div>
</md-content>