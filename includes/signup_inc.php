<?php

if(isset($_POST["submit"])){
    
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwd2 = $_POST["pwdrepeat"];

    $conn = require_once 'dbh_inc.php';
    require_once 'functions_inc.php';

    if(emptyInputSigup($name,$surname,$email,$pwd,$pwd2) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd,$pwd2) !== false){
        header("location: ../signup.php?error=notthesamepasswd");
        exit();
    }
    if(uidExist($conn,$email) !== false){
        header("location: ../signup.php?error=uidexist");
        exit();
    }

    createUser($conn,$name,$surname,$email,$pwd);

}
else{
    header("location: ../index.php");
    exit();
}

?>