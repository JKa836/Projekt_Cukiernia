<?php
$translationsTop10 = getTranslations($_SESSION["lang"], "top10");

// Funkcja do pobrania tłumaczenia nazwy ciasta
function getTranslatedCakeName($cakeID, $translations)
{
    $translatedCakeName = $translations["cakename_" . $cakeID];
    return $translatedCakeName;
}

// Funkcja do pobrania średniej oceny dla danego ciasta
function getAverageRating($productID)
{
    // Połączenie z bazą danych i pobranie średniej oceny
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn) {
        $ratingQuery = "SELECT AVG(Rating) AS averageRating FROM productreviews WHERE ProduktID = $productID";
        $ratingResult = mysqli_query($conn, $ratingQuery);

        if ($ratingResult && mysqli_num_rows($ratingResult) > 0) {
            $row = mysqli_fetch_assoc($ratingResult);
            $averageRating = $row['averageRating'];
            mysqli_free_result($ratingResult);
            mysqli_close($conn);
            return $averageRating;
        }
    }

    mysqli_close($conn);

    return 0;
}

// Połączenie z bazą danych i pobranie 10 ciast z najlepszą oceną
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'projekt_cukiernia';
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
mysqli_set_charset($conn, "utf8");
if ($conn) {
    $top10Query = "SELECT p.* FROM products AS p INNER JOIN productreviews AS pr ON p.ID = pr.ProduktID GROUP BY p.ID ORDER BY AVG(pr.Rating) DESC LIMIT 10";
    $top10Result = mysqli_query($conn, $top10Query);

    if ($top10Result && mysqli_num_rows($top10Result) > 0) {
        echo '<div class="cakes10">';
        echo '<h2 class="top">' . $translationsTop10["heading"] . '<img src="img/cake.png" alt="' . $translationsTop10["cakeImageAlt"] . '" class="cake-icon"></h2>';

        while ($cake = mysqli_fetch_assoc($top10Result)) {
            echo '<div class="cake10">';
            echo '<a href="cakedetails.php?id=' . $cake['ID'] . '">';
            echo '<img src="' . $cake['Zdjecie'] . '" alt="' . $cake['Nazwa'] . '">';
            echo '<h3>' . getTranslatedCakeName($cake['ID'], $translationsTop10) . '</h3>';
            echo '<p>' . $translationsTop10["price"] . $cake['Cena'] . ' zł</p>';
            echo '<p>' . $translationsTop10["quantity"] . $cake['Ilosc'] . '</p>';
            echo '<div class="rating">';
            echo $translationsTop10["rating"] . ' ';
            // Wyświetlanie gwiazdek na podstawie oceny
            $rating = getAverageRating($cake['ID']);
            $roundedRating = round($rating); // Zaokrąglanie wartości średniej oceny
            for ($i = 1; $i <= 5; $i++) {
                $ratecakeURL = 'ratecake.php?id=' . $cake['ID'];
                if ($i <= $rating) {
                    echo '<a href="' . $ratecakeURL . '"><span class="star filled"></span></a>';
                } else {
                    echo '<a href="' . $ratecakeURL . '"><span class="star unfilled"></span></a>';
                }
            }
            echo '</div>';
            echo '</a>';
            echo '<form method="post" action="addToCart.php" class="cart-form">';
            echo '<input type="hidden" name="product_id" value="' . $cake['ID'] . '">';
            echo $translationsTop10["quantity"] . '<input type="number" name="quantity" value="1" min="1" max="' . $cake['Ilosc'] . '">';
            echo '<input type="submit" value="' . $translationsTop10["addToCart"] . '">';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>';
    }
}

mysqli_close($conn);
?>