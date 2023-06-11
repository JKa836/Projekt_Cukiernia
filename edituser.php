<?php
    include_once 'header.php';
?>

<?php
    $name = $email = $pwd = $pwdrepeat = $surname = $newpwd = $updateSuc = "";
    $nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $surNameErr = $newpwdErr = $updateErr = "";

    // czyszczenie danych wejsciowych
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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
                $dbHost = 'localhost';
                $dbUser = 'root';
                $dbPassword = '';
                $dbName = 'projekt_cukiernia';

                $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                $user_id = $_SESSION['user_id']; // Zakładamy, że ID użytkownika jest przechowywane w sesji
                $sql = "UPDATE customers SET Imie='$name', Nazwisko='$surname', Email='$email' WHERE ID='$user_id'";
                
                $result = $conn->query($sql);

                if ($result === TRUE) {
                    $updateSuc = "Aktualizacja danych udana";
                    header("Location: edituser.php");
                    exit();
                } else {
                    $updateErr = "Błąd aktualizacji danych";
                    die("Błąd SQL: " . $conn->error);
                } 
            }
        
    }

?>
<div class="container">  
<section class="signup-form">
       <h2>Twoje dane</h2>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label>Imię:</label>
                <input type="text" name="name" autocomplete="off" value="<?= htmlspecialchars($user["Imie"])?>">
                <span><?php echo $nameErr; ?></span>
            </div> 
            <div>
                <label>Nazwisko:</label>
                <input type="text" name="surname" autocomplete="off" value="<?= htmlspecialchars($user["Nazwisko"])?>">
                <span><?php echo $surNameErr; ?></span>
            </div> 
            <div>
                <label>Email:</label>
                <input type="text" name="email" autocomplete="off" value="<?= htmlspecialchars($user["Email"])?>">
                <span><?php echo $emailErr; ?></span>
            </div> 
            <button type="submit" name="submit">Zmień dane</button>
    </form>
    <?php if (!empty($updateSuc)) : ?>
        <span class="errorLogin">
                <p><?php echo $updateSuc; ?></p>
        </span>
        <?php endif; ?>
</section>
</div>
<?php
    include_once 'footer.php';
?>