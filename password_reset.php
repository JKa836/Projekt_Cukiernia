<?php
include_once 'header.php';
?>

<?php
// Definicja zmiennych i ustawienie wartości domyślnych
$email = $securityQuestion = $securityAnswer = $newPassword = $confirmPassword = "";
$emailErr = $securityQuestionErr = $securityAnswerErr = $newPasswordErr = $confirmPasswordErr = "";

// Funkcja do oczyszczania danych wejściowych
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Walidacja dla adresu email
    if (empty($_POST["email"])) {
        $emailErr = "Adres email jest wymagany";
    } else {
        $email = sanitizeInput($_POST["email"]);
        // Sprawdzenie poprawności formatu adresu email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Nieprawidłowy format adresu email";
        } else {
            // Sprawdzenie, czy podany adres email istnieje w bazie danych
            $conn = require_once 'dbh_inc.php';
			mysqli_set_charset($conn, "utf8");
            $stmt = $conn->prepare("SELECT * FROM customers WHERE Email = ?");
            if (!$stmt) {
                die("Błąd SQL: " . $conn->error);
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                $emailErr = "Niepoprawny adres email";
            }
        }
    }

    // Walidacja dla wybranego pytania pomocniczego
    if (empty($_POST["securityQuestion"])) {
        $securityQuestionErr = "Wybór pytania pomocniczego jest wymagany";
    } else {
        $securityQuestion = sanitizeInput($_POST["securityQuestion"]);
    }

    // Walidacja dla odpowiedzi na pytanie pomocnicze
    if (empty($_POST["securityAnswer"])) {
        $securityAnswerErr = "Odpowiedź na pytanie pomocnicze jest wymagana";
    } else {
        $securityAnswer = sanitizeInput($_POST["securityAnswer"]);
    }

    // Walidacja dla nowego hasła
    if (empty($_POST["newPassword"])) {
        $newPasswordErr = "Nowe hasło jest wymagane";
    } else {
        $newPassword = sanitizeInput($_POST["newPassword"]);
        // Kryteria walidacji hasła (np. co najmniej 8 znaków, zawiera litery i cyfry)
        if (strlen($newPassword) < 8 || !preg_match("/[a-zA-Z]/", $newPassword) || !preg_match("/\d/", $newPassword)) {
            $newPasswordErr = "Nowe hasło musi mieć co najmniej 8 znaków i zawierać co najmniej jedną literę i jedną cyfrę";
        }
    }

    // Walidacja dla potwierdzenia hasła
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Potwierdzenie hasła jest wymagane";
    } else {
        $confirmPassword = sanitizeInput($_POST["confirmPassword"]);
        // Sprawdzenie, czy potwierdzenie hasła zgadza się z nowym hasłem
        if ($confirmPassword !== $newPassword) {
            $confirmPasswordErr = "Hasła nie są identyczne";
        }
    }

    if (empty($emailErr) && empty($securityQuestionErr) && empty($securityAnswerErr) && empty($newPasswordErr) && empty($confirmPasswordErr)) {
        // Sprawdzenie, czy podane dane są zgodne z danymi w bazie danych
        $stmt = $conn->prepare("SELECT * FROM customers 
                                INNER JOIN questionuser ON customers.ID = questionuser.KlientID
                                INNER JOIN question ON questionuser.PytanieID = question.ID
                                WHERE customers.Email = ? AND questionuser.Odpowiedz = ? AND questionuser.PytanieID = ?");
        if (!$stmt) {
            die("Błąd SQL: " . $conn->error);
        }
        $stmt->bind_param("ssi", $email, $securityAnswer, $securityQuestion);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $securityAnswerErr = "Nieprawidłowe dane";
        } else {
            // Aktualizacja hasła w bazie danych dla danego adresu email
            $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE customers SET Haslo = ? WHERE Email = ?");
            if (!$stmt) {
                die("Błąd SQL: " . $conn->error);
            }
            $stmt->bind_param("ss", $password_hash, $email);
            if ($stmt->execute()) {
                header("Location: password_reset_success.php");
                exit;
            } else {
                die("Błąd SQL: " . $stmt->error);
            }
        }
    }
}
?>
<div class="container">  
<section class="signup-form">
    <h2>Odzyskaj hasło</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="email">Adres email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" autocomplete="off">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
		<br>

        <div class="form-group">
            <label for="securityQuestion">Pytanie pomocnicze wybrane przy rejestracji:</label>
            <div class="select-wrapper">
                <select name="securityQuestion" id="securityQuestion" class="questionOption">
                    <option value="">Wybierz pytanie</option>
                    <option value="1">Jaki jest twój ulubiony kolor?</option>
                    <option value="2">Jak ma na imię twój zwierzak?</option>
                    <option value="3">Na jakiej ulicy mieszkasz?</option>
                    <option value="4">Jaki jest twój ulubiony serial?</option>
                </select>
                <div class="select-arrow"></div>
            </div>
            <span class="error"><?php echo $securityQuestionErr; ?></span>
        </div>
		<br>

        <div class="form-group">
            <label for="securityAnswer">Odpowiedź na pytanie pomocnicze:</label>
            <input type="text" name="securityAnswer" id="securityAnswer" value="<?php echo $securityAnswer; ?>" autocomplete="off">
            <span class="error"><?php echo $securityAnswerErr; ?></span>
        </div>
		<br>

        <div class="form-group">
            <label for="newPassword">Nowe hasło:</label>
            <input type="password" name="newPassword" id="newPassword">
            <span class="error"><?php echo $newPasswordErr; ?></span>
        </div>
		<br>

        <div class="form-group">
            <label for="confirmPassword">Potwierdź hasło:</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
        </div>
		<br>

        <div class="form-group">
            <button type="submit" class="btn">Zresetuj hasło</button>
        </div>
    </form>
</section>
</div>
<?php
include_once 'footer.php';
?>