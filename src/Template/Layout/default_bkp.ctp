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
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('custom.css') ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>    
    <?= $this->Html->script('main.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="row">
        <nav class="top-bar expanded menu" data-topbar role="navigation">
            <ul class="large-3 medium-4 columns">
                <li class="name menu-item">
                    <h1><?= $this->Html->Link('Logo','/') ?></h1>
                </li>
                <?php if($Auth->user()) { ?>
                <li class="name menu-item">
                    <h1><?= $this->Html->Link('Produtos','/produtos') ?></h1>
                </li>
                <li class="name menu-item">
                    <h1><?= $this->Html->Link('Usuários','/users') ?></h1>
                </li>
                <?php } ?>
            </ul>
            <?php if($Auth->user()){ ?>
            <ul class="large-2 medium-4 columns">
                <li class="name menu-item right">
                    <h1>
                        <a href="/users/logout" class="logout">
                            <span class="oi oi-account-logout" title="Logout" aria-hidden="true"></span>
                        </a>
                    </h1>
                </li>
            </ul>
            <?php } ?>
        </nav>    
    </div>
    <div class="row">
    <?= $this->Flash->render() ?>
    </div>
    
    <?= $this->fetch('content') ?>
    
    <div id="dialog" title="Basic dialog">
      <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
    </div>
    <footer>
    </footer>
</body>
</html>
