<?php
include_once 'header.php';
$translationsSignup = getTranslations($_SESSION["lang"], "signup");
?>
<?php
// Definiowanie zmiennych i ustawienie ich jako pustych
$name = $email = $pwd = $pwdrepeat = $surname = $answer = "";
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $surNameErr = $questErr = "";
// Funkcja do czyszczenia danych wejściowych
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    // Walidacja imienia
    if (empty($_POST["name"])) {
        $nameErr = $translationsSignup["name_required"];
    } else {
        $name = sanitizeInput($_POST["name"]);
        // Sprawdza czy zawiera litery
        if (!preg_match('/^[\p{L}]+$/u', $name)) {
            $nameErr = $translationsSignup["name_letters_only"];
        }
    }

    // Walidacja nazwiska
    if (empty($_POST["surname"])) {
        $surNameErr = $translationsSignup["surname_required"];
    } else {
        $surname = sanitizeInput($_POST["surname"]);
        // Sprawdza czy zawiera litery
        if (!preg_match('/^[\p{L}]+$/u', $surname)) {
            $surNameErr = $translationsSignup["surname_letters_only"];
        }
    }

    // Walidacja emaila
    if (empty($_POST["email"])) {
        $emailErr = $translationsSignup["email_required"];
    } else {
        $email = sanitizeInput($_POST["email"]);
        // Sprawdza poprawność formatu adresu email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = $translationsSignup["email_invalid_format"];
        }
    }

    // Walidacja hasła
    if (empty($_POST["pwd"])) {
        $passwordErr = $translationsSignup["password_required"];
    } else {
        $pwd = sanitizeInput($_POST["pwd"]);
        // Kryteria walidacji hasła (np. co najmniej 8 znaków, zawiera litery i cyfry)
        if (strlen($pwd) < 8 || !preg_match("/[a-zA-Z]/", $pwd) || !preg_match("/\d/", $pwd)) {
            $passwordErr = $translationsSignup["password_invalid_format"];
        }
    }

    // Walidacja powtórzenia hasła
    if (empty($_POST["pwdrepeat"])) {
        $confirmPasswordErr = $translationsSignup["confirm_password_required"];
    } else {
        $pwdrepeat = sanitizeInput($_POST["pwdrepeat"]);
        // Sprawdza czy hasła są takie same
        if ($pwdrepeat !== $pwd) {
            $confirmPasswordErr = $translationsSignup["passwords_do_not_match"];
        }
    }

    // Walidacja pytania
    if (empty($_POST["answer"])) {
        $questErr = $translationsSignup["answer_required"];
    } else {
        $answer = sanitizeInput($_POST["answer"]);
    }

    if (isset($_POST["pwd"])) {
    $password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
} else {
}

    // Jeśli nie ma żadnych błędów, następuje rejestracja
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($surNameErr) && empty($questErr)) {
        // Dodanie danych użytkownika do tabeli klientów
        $conn = require_once 'dbh_inc.php';
		mysqli_set_charset($conn, "utf8");
        $sql = "INSERT INTO customers (Imie,Nazwisko,Email,Haslo) VALUES (?,?,?,?)";

        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("Błąd SQL: " . $conn->error);
        }
        $stmt->bind_param("ssss", $_POST["name"], $_POST["surname"], $_POST["email"], $password_hash);

        if ($stmt->execute()) {
            // Pobranie ID ostatnio wstawionego rekordu
            $customerID = $stmt->insert_id;

            // Dodanie danych pytania pomocniczego do tabeli questionuser
            $questionID = $_POST["question"]; // ID pytania pomocniczego wybranego przez użytkownika

            $sqlQuestionUser = "INSERT INTO questionuser (KlientID, PytanieID, Odpowiedz) VALUES (?, ?, ?)";
            $stmtQuestionUser = $conn->prepare($sqlQuestionUser);
            if (!$stmtQuestionUser) {
                die("Błąd SQL: " . $conn->error);
            }
            $stmtQuestionUser->bind_param("iis", $customerID, $questionID, $answer);

            if ($stmtQuestionUser->execute()) {
                header("Location: signup_succsess.php");
                exit;
            } else {
                die("Błąd SQL: " . $stmtQuestionUser->error);
            }
        } else {
            die("Błąd SQL: " . $stmt->error);
        }
    }
}

?>
<?php

$conn = require_once 'dbh_inc.php';
$sql2 = "SELECT ID, Pytanie FROM question";
$result = $conn->query($sql2);

$options = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question_id = $row['ID'];
        $question_text = $row['Pytanie'];

        // Tłumaczenie pytania pomocniczego
        $translated_question_text = getTranslations($_SESSION["lang"], "signup")["question_" . $question_id];

        $options .= "<option value='$question_id'>$translated_question_text</option>";
    }
}

$conn->close();

?>
<div class="container">
    <section class="signup-form">
        <h2><?php echo $translationsSignup["register"]; ?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label><?php echo $translationsSignup["name"]; ?>:</label>
            <input type="text" name="name" autocomplete="off">
            <span><?php echo $nameErr; ?></span>
            <br><br>

            <label><?php echo $translationsSignup["surname"]; ?>:</label>
            <input type="text" name="surname" autocomplete="off">
            <span><?php echo $surNameErr; ?></span>
            <br><br>

            <label><?php echo $translationsSignup["email"]; ?>:</label>
            <input type="text" name="email" autocomplete="off">
            <span><?php echo $emailErr; ?></span>
            <br><br>

            <label><?php echo $translationsSignup["password"]; ?>:</label>
            <input type="password" name="pwd" autocomplete="off">
            <span><?php echo $passwordErr; ?></span>
            <br><br>

            <label><?php echo $translationsSignup["confirm_password"]; ?>:</label>
            <input type="password" name="pwdrepeat" autocomplete="off">
            <span><?php echo $confirmPasswordErr; ?></span>
            <br><br>

            <label><?php echo $translationsSignup["security_question"]; ?>:</label>
            <select name="question" class="questionOption">
                <?php echo $options; ?>
            </select>
            <input type="text" name="answer" autocomplete="off">
            <span><?php echo $questErr; ?></span>
            <br><br>
            <button type="submit" name="submit"><?php echo $translationsSignup["create_account"]; ?></button>
        </form>
    </section>
</div>
<?php
include_once 'footer.php';
?>