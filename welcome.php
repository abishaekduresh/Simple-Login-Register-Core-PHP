<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['fullName']) || !isset($_SESSION['email'])){
    header('Location: login.php');
    exit();
}
?>
<html>
    <head>
        <title>
            Welcome Page
        </title>
    </head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <body>

        <div class="container">
            <h2>Welcome, <?= $_SESSION['fullName']; ?>!</h2>
            <h2>Email: <?= $_SESSION['email']; ?></h2>
            <div class="container-group">                
                <a href="logout.php"><button type="button" class="container-button" >Logout</button></a>
            </div>
        </div>

    </body>
</html>