<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && !empty($_POST['submit'])) {
    $userName = trim($_POST['firstName']);
    $passWord = trim($_POST['lastName']);

    $db = new database('localhost', 'root', '', 'flowerpower', 'utf8');

    $db->logIn($userName, $passWord);
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="../script.js"></script>
</head>
<nav class="navbarContainer" id="navbar">
    <ul id="navbarList">
    </ul>
</nav>

<body id="body">
<div class="outer">
    <div class="middle">
        <div class="inner">
            <form action="index.php" method="post" id="loginForm">
                <h1 id="formTitle">Login</h1>

                <label for="loginInput">Voornaam</label><br>
                <input id="loginInput" type="text" name="firstName" placeholder="First name" pattern="[a-zA-Z0-9-]+"
                       required/><br>

                <label for="passwordInput">Achternaam</label><br>
                <input type="password" id="passwordInput" name="lastName" placeholder="Last name" required/><br>

                <input type="submit" name='submit' id="loginSubmitButton" value="submit"/><br>

            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>


