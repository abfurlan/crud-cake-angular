<md-dialog flex="50" aria-label="Cadastro"  ng-cloak>
    <form>
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Cadastro</h2>
                <span flex></span>
            </div>
        </md-toolbar>
        <md-dialog-content>
            <div class="md-dialog-content">
                <div class="form-input-group">
                    <label for="cod">Código</label>
                    <span class="f-right">Ativo?</span>
                    <div class="inline-group">
                        <input type="text" disabled class="form-input w-20" id="cod" name="cod" placeholder="Cod" ng-model="add.cd_produto" />
                        
                        <md-switch class="md-primary f-right" md-no-ink aria-label="Ativo" ng-model="add.id_status">
                            
                        </md-switch>

                    </div>

                </div>
                <div class="form-input-group">
                    <label>Descrição
                        <input type="text" class="form-input w-90" name="descricao"
                               required
                               ng-model="add.dc_descricao" 
                               placeholder="Descrição do produto"/>
                    </label>
                </div>
                <div class="form-input-group">
                    <label>Saldo
                        <input type="number" min="0" step="1" class="form-input w-10" name="saldo" ng-model="add.nm_saldo" placeholder="99" />
                    </label>
                </div>
                <div class="form-input-group">
                    <label for="preco">Preço</label>
                    <div class="inline-group">
                        <span>R$</span> <input type="number" step="0.1" class="form-input w-20" id="preco" ng-model="add.vl_preco" name="preco" placeholder="99,99" />
                    </div>
                </div>
            </div>
        </md-dialog-content>
        <md-dialog-actions layout="row">
            <span flex></span>
            <md-button ng-click="save(false)">
                CANCELAR
            </md-button>
            <md-button class="md-raised md-primary" ng-click="save(true)">
                GRAVAR
            </md-button>
        </md-dialog-actions>
    </form>
</md-dialog>