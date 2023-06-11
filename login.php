<?php
include_once 'header.php';
$translationsLogin = getTranslations($_SESSION["lang"], "login");

// połączenie z bazą danych
$conn = require_once 'dbh_inc.php';
mysqli_set_charset($conn, "utf8");

// Inicjalizacja zmiennych
$email = "";
$password = "";
$role = "";
$errors = array();

// Sprawdzenie, czy dane logowania zostały przesłane
if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["role"])) {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Walidacja adresów email
    if (empty($email)) {
        $errors[] = $translationsLogin["required_email"];
    }
    if (empty($password)) {
        $errors[] = $translationsLogin["required_password"];
    }

    // Logowanie na podstawie roli
    if (empty($errors)) {
        if ($role == "user") {
            // Check customer table
            $query = "SELECT * FROM customers WHERE Email='$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // Successful login, redirect to user page
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['Haslo'])) {
                    // Successful login, start session with user_id and redirect to user page
                    session_start();
                    session_regenerate_id();
                    $_SESSION['user_id'] = $row['ID'];
                    header("Location: index.php");
                    exit();
                } else {
                    $errors[] = $translationsLogin["invalid_credentials"];
                }
            } else {
                $errors[] = $translationsLogin["invalid_credentials"];
            }
        } elseif ($role == "employee") {
            // Check employee table
            $query = "SELECT * FROM employees WHERE Email='$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // Successful login, redirect to employee panel
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['Haslo'])) {
                    session_start();
                    session_regenerate_id();
                    $_SESSION['user_id'] = $row['ID'];
                    header("Location: panelpracownika.php");
                    exit();
                }
            } else {
                $errors[] = $translationsLogin["invalid_credentials"];
            }
        }
    }
}

?>
<div class="container">  
    <section class="signup-form">
        <h2><?= $translationsLogin["login"] ?></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="username"><?= $translationsLogin["email"] ?>:</label>
                <input type="text" name="email" value="<?php echo $email; ?>" autocomplete="off">
            </div>
            <div>
                <label for="password"><?= $translationsLogin["password"] ?>:</label>
                <input type="password" name="password" autocomplete="off">
            </div>
            <div>
                <label for="role"><?= $translationsLogin["role"] ?>:</label>
                <select name="role" id="selectUser">
                    <option value="user"><?= $translationsLogin["user"] ?></option>
                    <option value="employee"><?= $translationsLogin["employee"] ?></option>
                </select>
            </div>
            <div>
                <button type="submit"><?= $translationsLogin["login_button"] ?></button>
            </div>
            <span><a href="password_reset.php"><?= $translationsLogin["password_recovery"] ?></a></span>
            <?php if (!empty($errors)) : ?>
                <span class="errorLogin">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </span>
            <?php endif; ?>
        </form>
    </section>
</div>
<?php include_once 'footer.php'; ?>