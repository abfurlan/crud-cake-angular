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
              <div class="inline-group">
                  <input type="text" class="form-input w-20" id="cod" name="cod" placeholder="Cod" ng-model="add.cod" />
                <md-switch class="md-primary f-right" md-no-ink aria-label="Ativo" ng-model="add.status">
                    Ativo?
                </md-switch>
              </div>
            
          </div>
          <div class="form-input-group">
            <label>Descrição
                <input type="text" class="form-input w-90" name="descricao" ng-model="add.desc" placeholder="Descrição do produto"/>
            </label>
          </div>
          <div class="form-input-group">
            <label>Saldo
                <input type="text" class="form-input w-10" name="saldo" ng-model="add.saldo" placeholder="99" />
            </label>
          </div>
          <div class="form-input-group">
            <label for="preco">Preço</label>
            <div class="inline-group">
                <span>R$</span> <input type="text" class="form-input w-20" id="preco" ng-model="add.preco" name="preco" placeholder="99,99" />
            </div>
          </div>
      </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
      <span flex></span>
      <md-button ng-click="save()">
       CANCELAR
      </md-button>
      <md-button class="md-raised md-primary" ng-click="save()">
        GRAVAR
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>