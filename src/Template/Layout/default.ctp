<?php
$cakeDescription = 'Produtos';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('angular-material.min') ?>
    <?= $this->Html->css('md-data-table.min') ?>
    <?= $this->Html->css('style') ?>
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    
</head>
<body ng-app="BlankApp" ng-cloak>
    <?= $this->Flash->render() ?>
    <md-content ng-controller="AppCtrl">
        <md-toolbar class="md-theme-light">
            <div class="md-toolbar-tools">
                <md-button class="md-icon-button" ng-click="toggleRight()" aria-label="Settings">
                    <md-icon md-svg-icon="img/icons/ic_view_headline_white_24px.svg"></md-icon>
                </md-button>
                <h2>
                    <span>Produtos</span>
                </h2>
                <span flex></span>
            </div>
        </md-toolbar>
    </md-content>
    <div ng-controller="AppCtrl" layout="column" ng-cloak>
        <section layout="row" flex>
            <?= $this->fetch('content') ?>
            <md-sidenav class="md-sidenav-left md-whiteframe-4dp" md-component-id="sidenav-left">
                <md-toolbar class="md-theme-light">
                    <h1 class="md-toolbar-tools">Menu</h1>
                </md-toolbar>
                <md-content ng-controller="MenuCtrl" layout-padding>

                    <md-button ng-click="close()" class="md-primary">
                        Close Sidenav Left
                    </md-button>
                </md-content>
            </md-sidenav>
           
        </section>
    </div>
    <?= $this->Html->script('angular.min') ?>
    <?= $this->Html->script('angular-animate.min') ?>
    <?= $this->Html->script('angular-aria.min') ?>
    <?= $this->Html->script('angular-messages.min') ?>
    <?= $this->Html->script('angular-material.min') ?>
    <?= $this->Html->script('md-data-table.min') ?>
    <?= $this->Html->script('app') ?>
    <?= $this->Html->script('controller') ?>
    
    <?= $this->fetch('script') ?>
</body>
</html>
