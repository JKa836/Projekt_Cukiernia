<?php
    include_once 'header.php';
?>
<?php
// czyszczenie danych wejsciowych
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$pwd = $pwdrepeat = $newpwd = "";
$passwordErr = $confirmPasswordErr = $newPwdErr = $success = $error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($conn, "utf8");
    
    if (!$conn) {
        die('Błąd połączenia z bazą danych: ' . mysqli_connect_error());
    }

    // Pobranie identyfikatora użytkownika z sesji
    $userID = $_SESSION['user_id'];
    $oldPassword = $_POST['oldPassword'];
    // Walidacja hasła
     if (empty($_POST["newPassword"])) {
        $passwordErr = "Hasło jest wymagane";
    } else {
        $pwd = sanitizeInput($_POST["newPassword"]);
        // Password validation criteria (e.g., at least 8 characters, contains letters and numbers)
        if (strlen($pwd) < 8 || !preg_match("/[a-zA-Z]/", $pwd) || !preg_match("/\d/", $pwd)) {
            $passwordErr = "Hasło musi zawierać długość co najmniej 8 znaków oraz zawierać jedną cyfrę oraz literę";
        }
    }

    // Walidacja powtórzenia hasła
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Powtórzenie hasła jest wymagane";
    } else {
        $pwdrepeat = sanitizeInput($_POST["confirmPassword"]);
        // Sprawdza czy hasła są takie same
        if ($pwdrepeat !== $pwd) {
            $confirmPasswordErr = "Hasła nie pasują";
        }
    }

    if ($pwdrepeat !== $pwd) {
            $confirmPasswordErr = "Hasła nie pasują";
    } else {
        // Pobranie hasła z bazy danych dla danego użytkownika
        $passwordQuery = "SELECT Haslo FROM customers WHERE ID = ?";
        $passwordStatement = mysqli_prepare($conn, $passwordQuery);
        mysqli_stmt_bind_param($passwordStatement, 'i', $userID);
        mysqli_stmt_execute($passwordStatement);
        mysqli_stmt_bind_result($passwordStatement, $hashedPassword);
        mysqli_stmt_fetch($passwordStatement);
        mysqli_stmt_close($passwordStatement);

        // Sprawdzenie, czy stare hasło jest poprawne
        if (password_verify($oldPassword, $hashedPassword)) {
            // Sprawdzenie złożoności nowego hasła
            if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $pwd)) {
                // Zaszyfrowanie nowego hasła
                $newHashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

                // Aktualizacja hasła w bazie danych
                $updateQuery = "UPDATE customers SET Haslo = ? WHERE ID = ?";
                $updateStatement = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStatement, 'si', $newHashedPassword, $userID);
                mysqli_stmt_execute($updateStatement);
                mysqli_stmt_close($updateStatement);

                $success = 'Hasło zostało pomyślnie zmienione.';
            } else {
                $error = 'Nowe hasło nie spełnia wymagań złożoności.';
            }
        } else {
            $error = 'Podane stare hasło jest nieprawidłowe.';
        }
    }

    

    


    
}

?>
<div class="container">  
<section class="signup-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>    
                <label>Aktualne hasło:</label>
                <input type="password" name="oldPassword">
            </div>  
            <div>  
                <label>Nowe hasło:</label>
                <input type="password" name="newPassword"required>
            </div>
            <div>
                <label for="confirm_password">Potwierdź nowe hasło:</label>
                <input type="password" name="confirmPassword" id="confirm_password" required>
            </div>
            <button type="submit" name="submit">Zmień hasło</button>
    </form>
    <?php
    if (isset($error)) {
        echo '<div class="error">' . $error . '</div>';
    }
    if (isset($success)) {
        echo '<div class="success">' . $success . '</div>';
    }
    ?>
</section>
</div>
<?php
    include_once 'footer.php';
?>