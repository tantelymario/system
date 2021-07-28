<?php
/**Author       : Tantely Mario Rakotondrahova 
 * Modified     : 13-07-2021
 * Description  : --
*/ ?>
<html lang="en-US">
    <head>
        <link rel='stylesheet' id='sgdotcom-styles-css'  href='public/css/system/index.css' type='text/css' media='all' />
        <link rel='stylesheet' id='sgdotcom-styles-css'  href='public/css/system/bootstrap.css' type='text/css' media='all' />
        <title>System</title>
    </head>
    <body>
    <div class="screen" style="background-image: url('assets/wall.jpg');background-size: contain;">
        <div class="icon_terminal" ></div>
    </div>
	<div class="cli-body fenetre">
        <ul class="list-group command-list">
            <li class="command active"><span class="cli_user">root@equipe-rd$</span><span class="cmd_val_r cmd_val"></span></li>
        </ul>

    </div>
    <input type="text" value="" id="cli-value">
    </body>
    <script type="text/javascript" src="public/js/system/jquery.js"></script>
    <script type="text/javascript" src="public/js/modules/Fenetre.js"></script>
    <script type="text/javascript" src="public/js/system/index.js"></script>
</html>