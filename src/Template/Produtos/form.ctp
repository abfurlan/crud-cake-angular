<md-dialog aria-label="Cadastro"  ng-cloak>
  <form>
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Cadastro</h2>
        <span flex></span>
      </div>
    </md-toolbar>
    <md-dialog-content>
      <div class="md-dialog-content">
          
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