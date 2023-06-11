<?php
/* 
$_POST["name"] $nameErr
$_POST["surname"] $surNameErr;
$_POST["email"] $emailErr;
$_POST["pwd"] $passwdErr;
$_POST["pwdrepeat"] $confirmPasswordErr;

*/
 // Define variables and set to empty values
 $name = $email = $pwd = $pwdrepeat = $surname =  "";
 $nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $surNameErr= "";
// czyszczenie danych wejsciowych
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(isset($_POST["submit"])){
    



    // Walidacja imienia
    if (empty($_POST["name"])) {
        $nameErr = "Imie jest wymagane";
    } else {
        $name = sanitizeInput($_POST["name"]);
        // Sprawdza czy zawiera litery
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Imię musi zawierać tylko litery";
        }
    }

    // Walidacja nazwiska
    if (empty($_POST["surname"])) {
        $surNameErr = "Nazwisko jest wymagane";
    } else {
        $surname = sanitizeInput($_POST["surname"]);
        // Sprawdza czy zawiera litery
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $surNameErr = "Nazwisko musi zawierać tylko litery";
        }
    }

    // Walidacja emaila
    if (empty($_POST["email"])) {
        $emailErr = "Email jest wymagany";
    } else {
        $email = sanitizeInput($_POST["email"]);
        // Check if email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Zły format Emaila";
        }
    }

     // Walidacja hasła
     if (empty($_POST["pwd"])) {
        $passwordErr = "Hasło jest wymagane";
    } else {
        $pwd = sanitizeInput($_POST["pwd"]);
        // Password validation criteria (e.g., at least 8 characters, contains letters and numbers)
        if (strlen($pwd) < 8 || !preg_match("/[a-zA-Z]/", $pwd) || !preg_match("/\d/", $pwd)) {
            $passwordErr = "Hasło musi zawierać długość co najmniej 8 znaków oraz zawierać jedną cyfrę oraz literę";
        }
    }

     // Walidacja powtórzenia hasła
     if (empty($_POST["pwdrepeat"])) {
        $confirmPasswordErr = "Powtórzenie hasła jest wymagane";
    } else {
        $pwdrepeat = sanitizeInput($_POST["pwdrepeat"]);
        // Sprawdza czy hasła są takie same
        if ($pwdrepeat !== $pwd) {
            $confirmPasswordErr = "Hasła nie pasują";
        }
    }
    
    $password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    
    // Jeśli błędów nie ma następuje logowanie
        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($surNameErr)) {
            // Process the registration (e.g., store data in the database)
            $conn = require_once 'dbh_inc.php';
            $sql = "INSERT INTO customers (Imie,Nazwisko,Email,Haslo) VALUES (?,?,?,?)";
            
            $stmt = $conn->stmt_init();
            if (! $stmt->prepare($sql)){
                die("Błąd SQL: ". $conn->error);
            }
            $stmt->bind_param("ssss",$_POST["name"],$_POST["surname"],$_POST["email"],$password_hash);
        
            if($stmt->execute()){
                header("Location: signup_succsess.php");
                exit;
            }   
        }
    
}
else{
    header("location: index.php");
    exit();
}
?>