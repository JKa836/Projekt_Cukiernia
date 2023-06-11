<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["user_id"])) {
    $mysqli = require "dbh_inc.php";
    $sql = "SELECT * FROM customers WHERE id = {$_SESSION["user_id"]}";
    $result = mysqli_query($mysqli, $sql);
    $user = $result->fetch_assoc();
}

// Ustawienie domyślnego motywu
$defaultTheme = 'light';

// Sprawdzenie, czy użytkownik kliknął przycisk zmiany motywu
if (isset($_POST['theme']) && $_POST['theme'] === 'dark') {
    $_SESSION['theme'] = 'dark'; // Zapisanie motywu w sesji
} elseif (isset($_POST['theme']) && $_POST['theme'] === 'light') {
    $_SESSION['theme'] = 'light'; // Zapisanie motywu w sesji
}

// Pobranie aktualnie wybranego motywu
$selectedTheme = isset($_SESSION['theme']) ? $_SESSION['theme'] : $defaultTheme;

// Funkcja do wyświetlania przycisku zmiany motywu
function displayThemeToggleButton($currentTheme)
{
    $otherTheme = $currentTheme === 'light' ? 'dark' : 'light';
    $translations = getTranslations($_SESSION["lang"], "header");
    echo '<form method="post">';
    echo '<button type="submit" name="theme" value="' . $otherTheme . '" class="theme-button">';
    echo $translations["theme"][$otherTheme]; // Wykorzystaj tłumaczenie dla danego motywu
    echo '</button>';
    echo '</form>';
}

// Funkcja do wczytywania tłumaczeń
function getTranslations($lang, $filePrefix)
{
    $file = "translations/" . $filePrefix . "_" . $lang . ".json";
    $json = file_get_contents($file);
    return json_decode($json, true);
}

// Sprawdź, czy wartość języka została wybrana
if (isset($_POST["langSwitcher"])) {
    $_SESSION["lang"] = $_POST["langSwitcher"];
}

// Sprawdź, czy sesja języka istnieje, jeśli nie, ustaw wartość domyślną na "pl"
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = "pl";
}

$translationsHeader = getTranslations($_SESSION["lang"], "header");
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION["lang"] ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep internetowo-cukierniczy</title>
    <link rel="icon" href="img/logo2.png">
    <!--pliki css -->
    <link id="theme-style" rel="stylesheet" href="css/style.css">
    <?php
    if ($selectedTheme === 'dark') {
        echo '<link rel="stylesheet" href="css/dark-mode.css">'; // Styl dla motywu ciemnego
    }
    ?>
    <!--skrypty -->

</head>
<body>

<!--nagłówek -->
<header>
    <div class="logo"><?= $translationsHeader["logo"] ?></div>
    <nav>
        <ul class="nav_links">
            <li><a href="index.php"><?= $translationsHeader["home"] ?></a></li>
            <li><a href="testshop.php"><?= $translationsHeader["shop"] ?></a></li>
            <li><a href="onas.php"><?= $translationsHeader["about"] ?></a></li>
            <?php if (isset($user)): ?>
                <li class="dropdown"><a href="userinfo.php"><?= $translationsHeader["welcome"] ?> <?= htmlspecialchars($user["Imie"]) ?></a></li>
                <li><a href="logout.php"><?= $translationsHeader["logout"] ?></a></li>
            <?php else: ?>
                <li><a href="login.php"><?= $translationsHeader["login"] ?></a></li>
                <li><a href="signup.php"><?= $translationsHeader["signup"] ?></a></li>
            <?php endif; ?>
            <li>
                <form method="post" class="langForm">
                    <select class="langOption" id="langSwitcher" name="langSwitcher" onchange="this.form.submit()">
                        <option value="pl" <?= ($_SESSION["lang"] == "pl") ? "selected" : "" ?>>PL</option>
                        <option value="en" <?= ($_SESSION["lang"] == "en") ? "selected" : "" ?>>EN</option>
                    </select>
                </form>
            </li>
            <li>
                <?php
                // Wyświetlanie przycisku zmiany motywu
                displayThemeToggleButton($selectedTheme);
                ?>
            </li>
            <?php if (isset($user)): ?>
                <li><a href="cart.php"><?= $translationsHeader["cart"] ?></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>