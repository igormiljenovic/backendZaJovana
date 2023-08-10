<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";

});


$users = new Users();

?>



<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Auris</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/x-icon" href="assets/pics/favicon.ico">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>



<?php


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  Session::destroy();
}



 ?>

<header style="margin:0; height:7% !important;">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header" style="margin:0; height:100%; padding:0;">
        <a class="navbar-brand" href="index.php" style="padding:5px !important"><img style="height:100%"
                src="assets/pics/auralogo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto" style="float:right">



                <?php if (Session::get('id') == TRUE) { ?>
                <?php if (Session::get('roleid') == '3' or Session::get('roleid') == '1') { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Polisa</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="polisa.php">Pregled Polisa</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="prebacisifruzastupnika.php">Prebaci Polise</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="planpremije.php">Plan Premije</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Avans</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="stanjeavansa.php">Stanje Avansa</a>
                        <a class="dropdown-item" href="formaavans.php">Unos Avansa</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="prebaciavanszastupnika.php">Prebaci Avans</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Zastupnik</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="masterzastupnik.php">Unos Master Zastupnika</a>
                        <a class="dropdown-item" href="zastupnik.php">Unos Zastupnika</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Troškovi</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="zastupniktroskovi.php">Unos Troškova Zastupnika</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="prebacitrosakzastupnika.php">Prebaci Trošakove Zastupnika</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Popusti</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="formapopusti.php">Pregled Popusta</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item disabled" href="premijskipopusti.php">Premijski Popusti (BETA)</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Import</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="importPolise.php">Import Polisa iz Insurenca</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="importPolisePJUP.php">Import Polise PUJP</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="importIzmjena.php">Import Korekcija</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="importTroskovaZastupnika.php">Import Troškova Zastupnika</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="importAvansa.php">Import Avansa</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="importProvizijaZastupnika.php">Import Provizija
                            Zastupnika(Externo)</a>
                    </div>
                </li>
                <?php }; ?>

                <?php if (Session::get('roleid') == '1') { ?>
                <li class="nav-item">

                    <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>User lists </span></a>
                </li>
                <li class="nav-item

              <?php

                          $path = $_SERVER['SCRIPT_FILENAME'];
                          $current = basename($path, '.php');
                          if ($current == 'addUser') {
                            echo " active ";
                          }

                         ?>">

                    <a class="nav-link" href="addUser.php"><i class="fas fa-user-plus mr-2"></i>Add user </span></a>
                </li>
                <?php  }; ?>

                <li class="nav-item">
                    <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Odjavi se</a>
                </li>
                <?php }else{ ?>


                <li class="nav-item
                <?php

                    				$path = $_SERVER['SCRIPT_FILENAME'];
                    				$current = basename($path, '.php');
                    				if ($current == 'login') {
                    					echo " active ";
                    				}

                    			 ?>">
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Prijavi se</a>
                </li>

                <?php } ?>


            </ul>

        </div>
    </nav>
</header>

<body>