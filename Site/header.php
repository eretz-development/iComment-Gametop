<?php

    include 'includes/dbh.inc.php';

    session_start();
    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        //echo "<h1>CA MARCHE</h1>";
    }else{$uid = '';}
    if(isset($_GET['mail'])){
        $mail = $_GET['mail'];
    }else{$mail = '';}
    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }else{$error = '';}

    /*
    
    try{
        $uid = $_GET['uid']
    } catch($e){
        $uid = '';
    }
    try{
        $mail = $_GET['mail']
    } catch($e){
        $mail = '';
    }
    
    */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <header id="header" class="glass">

        <div>
            
            <a href="index.php" id="logo">iComment</a>

            <ul class="navBar">

                <li onclick="location.href='index.php#start';">
                    <p>Get Started</p>
                </li>
                <!-- Pas de balise <a href=""> </a>  parceque c'est plus simple de centrer le texte en ayant une grande hitbox -->
                <li onclick="location.href='index.php#about';">
                    <p>About</p>
                </li>

                <?php

                    if (isset($_SESSION['userId'])) {    //comme il y a plein de guillemets et de balises c'est plus simple d'ouvrir et fermer du php autour de l'html plutot que de mettre l'html dans le php avec echo?>
                        <li onclick="location.href='includes/logout.inc.php';">
                            <p>Log Out</p>
                        </li> <?php
                    } 
                    else { ?>
                        <li>
                            <a href="#login" id="logBtn">
                                <p>Login / Sign Up</p>
                            </a>
                        </li><?php
                    }
                ?>
                
            </ul>

            <h2 id='username'><?php if(isset($_SESSION['userUid'])){ echo "@" . $_SESSION['userUid'];}?></h2>

            <form id="searchBar" action="includes/search.php" method="POST">
                <input type="text" name="search" id="textInput" placeholder="Let's search for a website!">
                <button type="submit" name="submit-search" id="searchButton">⌕</button>
            </form>

        </div>

    </header>

    <div id="login" class="log glass">
        <form class='login' action='includes/login.inc.php' method='post'>
            <input type='text' name='mailuid' placeholder='Username/Email...'>
            <input type='password' name='pwd' placeholder='Password...'>
            <button type='submit' name='login-submit'>Login</button>
            <a href="#signup">Not signed up yet?</a>
        </form>
    </div>
    
    
    <div id="content-blocker-holder"></div>
    <div id="signup" class="log glass">
        <form class="signup" action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username..." value="<?php echo $uid ?>"/>
            <input type="text" name="mail" placeholder="Email..." value="<?php echo $mail ?>">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwd-repeat" placeholder="Repeat Password...">
            <button type="submit" name="signup-submit">Sign up</button>
            <a href="#login">Already have an account?</a>
        </form>
    </div>

    <?php if($error){
        if($error == "nouser"){
            $errorText = "No such user.";
        }
        else if($error == "wrongpassword"){
            $errorText = "Wrong password.";
        }
        else if($error == "emptyfields"){
            $errorText = "Please fill all fields.";
        }
        else if($error == "invalidmail"){
            $errorText = "Please use a valid Email.";
        }
        else if($error == "emailtaken"){
            $errorText = "This email is already used.";
        }
        else{
            $errorText = "http://bitly.com/98K8eH";
        }
    }
    if(isset($_GET['success'])){
            $success = $_GET['success'];
    } else {$success = '';}

    if($success){
        if($success == "signup"){
            $successText = "Successfully signed in!";
        } else if($success == "login"){
            $successText = "Successfully loged in!";
        } else if($success == "logout"){
            $successText = "Successfully loged out!";
        }
        else{$successtext = "http://bitly.com/98K8eH";}
    }

    if($error){ ?> <!-- holy shit du premier coup -->
        <div id="errorBox" class="glass">
            <a onclick="document.getElementById('errorBox').style.maxHeight = '0'; setTimeout(function() {document.getElementById('errorBox').style.border = 'none'}, 300)">x</a> <!-- setTimeout(fonction, temps) c'est un peu comme un delay, pour pas qu'on voit un trait rouge apres la fermeture de la notification, mais que la bordure reste au moins jusqu'a ce qu'elle se soit barrée-->
            <p><?php echo $errorText ?></p>
        </div> <?php 
    }

    if($success){ ?>
        <div id="successBox" class="glass">
            <a onclick="document.getElementById('successBox').style.maxHeight = '0'; setTimeout(function() {document.getElementById('successBox').style.border = 'none'}, 300)">x</a> <!-- setTimeout(fonction, temps) c'est un peu comme un delay, pour pas qu'on voit un trait rouge apres la fermeture de la notification, mais que la bordure reste au moins jusqu'a ce qu'elle se soit barrée-->
            <p><?php echo $successText ?></p>
        </div> <?php 
    } ?>
