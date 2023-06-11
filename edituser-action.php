<?php
    include_once 'edituser.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    

        // Walidacja imienia
        if (empty($_POST["name"])) {
            $nameErr = "Imie jest wymagane";
        } else {
            $name = sanitizeInput($_POST["name"]);
            // Sprawdza czy zawiera litery
            if (!preg_match('/^[\p{L}]+$/u', $name)) {
                $nameErr = "Imię musi zawierać tylko litery";
            }
        }
    
        // Walidacja nazwiska
        if (empty($_POST["surname"])) {
            $surNameErr = "Nazwisko jest wymagane";
        } else {
            $surname = sanitizeInput($_POST["surname"]);
            // Sprawdza czy zawiera litery
            if (!preg_match('/^[\p{L}]+$/u', $name)) {
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
    
        // Jeśli błędów nie ma następuje edycja danych
            if (empty($nameErr) && empty($emailErr) && empty($surNameErr))  {
                // Aktualizacja danych
                $conn = require_once 'dbh_inc.php';
                $user_id = $_SESSION['user_id']; // Zakładamy, że ID użytkownika jest przechowywane w sesji
                $sql = "UPDATE customers SET Imie='$name', Nazwisko='$surname', Email='$email' WHERE ID='$user_id'";
                
                $result = $conn->query($sql);

                if ($result === TRUE) {
                    $updateSuc = "Aktualizacja danych udana";
                } else {
                    $updateErr = "Błąd aktualizacji danych";
                    die("Błąd SQL: " . $conn->error);
                } 
            }
        
    }
?>