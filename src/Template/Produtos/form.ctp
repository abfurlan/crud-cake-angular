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
              <input type="text" class="form-input w-20" id="cod" name="cod" placeholder="Cod" />
            
          </div>
          <div class="form-input-group">
            <label>Descrição
                <input type="text" class="form-input w-90" name="descricao" placeholder="Descrição do produto"/>
            </label>
          </div>
          <div class="form-input-group">
            <label>Saldo
                <input type="text" class="form-input w-10" name="saldo" placeholder="99" />
            </label>
          </div>
          <div class="form-input-group">
            <label for="preco">Preço</label>
            <div class="inline-group">
                <span>R$</span> <input type="text" class="form-input w-20" id="preco" name="preco" placeholder="99,99" />
            </div>
          </div>
      </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
      <span flex></span>
      <md-button ng-click="answer('not useful')">
       CANCELAR
      </md-button>
      <md-button class="md-raised md-primary" ng-click="answer('useful')">
        GRAVAR
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>