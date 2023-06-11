<?php

function emptyInputSigup($name,$surname,$email,$pwd,$pwd2){
    $result;
    if (empty($name)||empty($surname)||empty($email)||empty($pwd)||empty($pwd2)){
        $result = true;
    }
    else{
        $result = false;

    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd,$pwd2){
    $result;
    if($pwd !== $pwd2){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExist($conn,$email){
    $sql = "SELECT * FROM customers where Email = ?;";
    $stmt = mysqli_stmt_init($conn,$sql);

    if(!mysqli_stmt_prepare($conn,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn,$name,$surname,$email,$pwd){
    $sql = "INSERT INTO customers (Imie,Nazwisko,Email,Haslo) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn,$sql);

    if(!mysqli_stmt_prepare($conn,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssss",$name,$surname,$email,$hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();
}
?>