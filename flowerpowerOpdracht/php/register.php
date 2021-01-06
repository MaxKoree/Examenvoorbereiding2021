<?php
include 'database.php';
include 'helper.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && !empty($_POST['submit'])){

    $fields = [
        'fname', 'lname', 'email', 'uname', 'pwd', 'cpwd'
    ];

    $obj = new Helper();

    $fields_validated = $obj->field_validation($fields);

    if($fields_validated){

        $uname = trim(strtolower($_POST['uname']));
        $fname = trim(strtolower($_POST['fname']));

        $mname = isset($_POST['mname']) ? trim(strtolower($_POST['mname'])) : NULL; //nullable
        $lname = trim(strtolower($_POST['lname']));
        $email = trim(strtolower($_POST['email']));
        $pwd = trim(strtolower($_POST['pwd']));
        $cpwd = trim(strtolower($_POST['cpwd']));

        if($pwd !== $cpwd){
            $pwdError = "Passwords do not match. Please fix your input errors and try again.";
        }else{
            $db = new database('localhost', 'root', '', 'project1', 'utf8');

            $db->sign_up($uname, $fname, $mname, $lname, $email, $pwd);
        }
    }else{
        $missingFieldError = "Input for one of more fields missing. Please provide all required values and try again.";
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="signup.php" method="post">
            <input type="text" name="fname" placeholder="Voornaam" value="<?php echo isset($_POST["fname"]) ? htmlentities($_POST["fname"]) : ''; ?>" required /><br>
            <input type="text" name="mname" placeholder="Tussenvoegsel" value="<?php echo isset($_POST["mname"]) ? htmlentities($_POST["mname"]) : ''; ?>"/><br>
            <input type="text" name="lname" placeholder="Achternaam" value="<?php echo isset($_POST["lname"]) ? htmlentities($_POST["lname"]) : ''; ?>" required /><br>
            <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST["email"]) ? htmlentities($_POST["email"]) : ''; ?>" required /><br>
            <input type="text" name="uname" placeholder="Gebruikersnaam" value="<?php echo isset($_POST["uname"]) ? htmlentities($_POST["uname"]) : ''; ?>" required /><br>
            <input type="password" name="pwd" placeholder="Wachtwoord" required /><br>
            <input type="password" name="cpwd" placeholder="Herhaal wachtwoord" required /><br>
            <span><?php echo ((isset($pwdError) && $pwdError != '') ? htmlentities($pwdError) ." <br>" : '')?></span>
            <input type="submit" name="submit" value="Sign up!"/>
            <a href="index.php">Ik heb al een account. Login!</a>
            <span><?php echo ((isset($missingFieldError) && $missingFieldError != '') ? htmlentities($missingFieldError) : '')?></span>
        </form>
    </body>
</html>