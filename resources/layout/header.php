<!DOCTYPE html>
<html lang="en">
<head>
    
    <!--Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="<?=CLIENT_ID?>">
    
    <!-- App Name -->
    <title><?=APP_NAME?></title>
    
    <!-- App Icon-->
    <link rel="icon" href="resources/images/favicon.png">
    <!-- Styles -->
    <link href="resources/css/app.css" rel="stylesheet">
    
    <!-- Template -->
    <script src="resources/js/app.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Google Sign In -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="resources/js/gplus.js"></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <b>
                        <a class="navbar-brand" href="<?=BASE_NAME?>" <? if(!empty($_SESSION['__email_verified__'])) { ?>style="padding: 11px 15px;"<? } ?>>
                            <?=APP_NAME?>
                        </a>
                    </b>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <? if(!empty($_SESSION['__email_verified__'])) { ?> 
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?=$_SESSION['__name__']?> <span class="caret"></span>
                            </a>                            
                            <ul class="dropdown-menu" role="menu">
                                <? if(basename($_SERVER['PHP_SELF']) != "admin.php") { ?>
                                <li>
                                     <a href="admin.php">
                                        Go to Dashboard
                                    </a>
                                </li>
                                <? } ?>
                                <li>
                                     <a href="#" onclick="window.open('logout.php','Logout','height=600,width=600');location.reload();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <? } else { ?>                       
                        <li>
                            <a href="#" role="button" aria-expanded="false" class="g-signin2" data-onsuccess="onSignIn">
                                Sign In
                            </a>
                        </li>
                        <? } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">                    