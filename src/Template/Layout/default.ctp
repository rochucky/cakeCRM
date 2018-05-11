<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Software';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <?= $this->Html->css('open-iconic-master/font/css/open-iconic-bootstrap.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../js/datatable/datatables.min.css') ?>
    <?= $this->Html->css('noty.css') ?>
    <?= $this->Html->css('custom.css') ?>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('datatable/datatables.min.js') ?>
    <?= $this->Html->script('noty.js') ?>
    <?= $this->Html->script('util.js') ?>
    <?= $this->Html->script('main.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    
    <!-- Change Password Modal -->
    <div class="modal fade" id="password-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Alterar Senha</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
                <div class="col">
                    <form id="password-form" action="/Users/salvar">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="current">Senha Atual</label>
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="current" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="current">Nova Senha</label>
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="new" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="current">Confirmar Senha</label>
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="confirm" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary do-nothing save-new-password" data-dismiss="modal">Salvar</button>
            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancelar</button>
          </div>

        </div>
      </div>
    </div>
    
    <!-- Menu -->
    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="#">Instore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($Auth->user()): ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/produtos">Produtos</a>
                </li>
                <?php if($user_type != 'user'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/users">Usuários</a>
                        <a class="dropdown-item" href="/userTypes">Tipos de Usuário</a>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <a href="" class="nav-link" data-toggle="modal" data-target="#password-modal">
                    <span class="oi oi-lock-locked" title="Alterar Senha" aria-hidden="true"></span>
                </a>
                <a href="/users/logout" class="nav-link">
                    <span class="oi oi-account-logout" title="Logout" aria-hidden="true"></span>
                </a>
            </ul>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
            </div>        
        </div>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
