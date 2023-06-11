<?php
$conn = require_once 'dbh_inc.php';
mysqli_set_charset($conn, "utf8");

// Pobranie ID ciasta z parametru GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cakeID = $_GET['id'];
} else {
    echo 'Nieprawidłowe ID ciasta.';
    include_once 'footer.php';
    exit();
}

// Pobranie informacji o ciastach
$cakeQuery = "SELECT * FROM products WHERE ID = $cakeID";
$cakeResult = mysqli_query($conn, $cakeQuery);
$cake = mysqli_fetch_assoc($cakeResult);

if (!$cake) {
    echo 'Nie znaleziono ciasta.';
    include_once 'footer.php';
    exit();
}

// Sprawdzenie, czy sesja jest już rozpoczęta
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = "ratecake.php?id=$cakeID";
    header("Location: login.php");
    exit();
}

// Sprawdzenie, czy użytkownik już ocenił to ciasto
$userID = $_SESSION['user_id'];
$existingRatingQuery = "SELECT * FROM productreviews WHERE ProduktID = $cakeID AND KlientID = $userID";
$existingRatingResult = mysqli_query($conn, $existingRatingQuery);
$existingRating = mysqli_fetch_assoc($existingRatingResult);

// Dodawanie lub aktualizowanie oceny
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Walidacja oceny
    $rating = $_POST["rating"];
    if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
        $errors[] = "Nieprawidłowa ocena. Podaj liczbę od 1 do 5.";
    }

    // Dodawanie lub aktualizowanie oceny w bazie danych
    if (empty($errors)) {
        if ($existingRating) {
            // Aktualizacja oceny
            $reviewID = $existingRating['ID'];
            $query = "UPDATE productreviews SET Rating = $rating WHERE ID = $reviewID";
        } else {
            // Dodawanie nowej oceny
            $query = "INSERT INTO productreviews (ProduktID, KlientID, Rating) VALUES ($cakeID, $userID, $rating)";
        }

        mysqli_query($conn, $query);

        // Przekierowanie po dodaniu/aktualizacji oceny
        header("Location: testshop.php");
        exit();
    }
}

include_once 'header.php';
?>
<div class="container">  
<section class="cake-details">
    <h2><?php echo $cake['Nazwa']; ?></h2>
    <div class="cake-rate-info">
        <div class="cake-rate">
            <img src="<?php echo $cake['Zdjecie']; ?>" alt="Cake Image">
        </div>
    </div>
</section>

<section class="rate-cake">
    <h2>Oceń ciasto</h2>
    <div class="cake-rating">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <?php if ($existingRating) : ?>
                <form method="post" action="<?php echo htmlspecialchars('ratecake.php?id=' . $cakeID); ?>">
                    <div class="rating-input">
                        <label for="rating">Twoja ocena:</label>
                        <input type="number" name="rating" min="1" max="5" value="<?php echo $existingRating['Rating']; ?>" required>
                    </div>
                    <div class="rating-submit">
                        <button type="submit">Zmień ocenę</button>
                    </div>
                </form>
            <?php else : ?>
                <form method="post" action="<?php echo htmlspecialchars('ratecake.php?id=' . $cakeID); ?>" >
                    <div class="rating-input">
                        <label for="rating">Twoja ocena:</label>
                        <input type="number" name="rating" min="1" max="5" required>
                    </div>
                    <div class="rating-submit">
                        <button type="submit">Dodaj ocenę</button>
                    </div>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
</div>
<?php include_once 'footer.php'; ?>
