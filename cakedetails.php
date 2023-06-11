<?php
include_once 'header.php';

$translationsCakedetails = getTranslations($_SESSION["lang"], "cakedetails");

?>

<div class="cake-details">
    <?php
    // Połączenie z bazą danych i pobranie szczegółowych informacji o cieście
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($conn, "utf8");

    if (!$conn) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $cakeID = $_GET['id'];
        $cakeQuery = "SELECT p.*, c.Nazwa AS Kategoria, pc.KategoriaID 
                      FROM products AS p 
                      INNER JOIN productcategories AS pc ON p.ID = pc.ProduktID 
                      INNER JOIN categories AS c ON pc.KategoriaID = c.ID 
                      WHERE p.ID = $cakeID";
        $cakeResult = mysqli_query($conn, $cakeQuery);

        if ($cakeResult && mysqli_num_rows($cakeResult) > 0) {
            $cake = mysqli_fetch_assoc($cakeResult);

            echo '<div class="cake-image">';
            echo '<img src="' . $cake['Zdjecie'] . '" alt="' . $cake['Nazwa'] . '">';
            echo '</div>';

            echo '<div class="cake-info">';
            echo '<h2>';

            if ($_SESSION["lang"] === "pl") {
                echo $cake['Nazwa'];
            } elseif ($_SESSION["lang"] === "en") {
                $translationsCakeNames = json_decode(file_get_contents('translations/cakedetails_en.json'), true);
                $cakeName = $translationsCakeNames['cakename_' . $cake['ID']];
                if ($cakeName) {
                    echo $cakeName;
                }
            }

            echo '</h2>';
            echo '<p><strong>' . $translationsCakedetails['category'] . ':</strong> ';

            if ($_SESSION["lang"] === "pl") {
                echo $cake['Kategoria'];
            } elseif ($_SESSION["lang"] === "en") {
                $translationsCakeCategories = json_decode(file_get_contents('translations/cakedetails_en.json'), true);
                $categoryKey = 'cakecategory_' . $cake['KategoriaID'];
                $cakeCategory = $translationsCakeCategories[$categoryKey] ?? '';
                if ($cakeCategory) {
                    echo $cakeCategory;
                } else {
                    echo $cake['Kategoria']; // Wyświetl nazwę kategorii z bazy danych, jeśli brak tłumaczenia
                }
            }

            echo '</p>';
            echo '<p><strong>' . $translationsCakedetails['price'] . ':</strong> ' . $cake['Cena'] . ' zł</p>';
            echo '<p><strong>' . $translationsCakedetails['quantity'] . ':</strong> ' . $cake['Ilosc'] . '</p>';
            echo '</div>';

            echo '<div class="cake-description">';
            echo '<h3>' . $translationsCakedetails['description'] . ':</h3>';

            if ($_SESSION["lang"] === "pl") {
                echo '<p>' . $cake['Opis'] . '</p>';
            } elseif ($_SESSION["lang"] === "en") {
                $translationsCakeDescription = json_decode(file_get_contents('translations/cakedetails_en.json'), true);

                $cakeDescription = $translationsCakeDescription['cake_' . $cake['ID']];
                if ($cakeDescription) {
                    echo '<p>' . $cakeDescription . '</p>';
                }
            }
            echo '</div>';

            echo '<div class="cake-rating">';
            echo '<h3>' . $translationsCakedetails['rating'] . ':</h3>';
            echo '<div class="rating">';
            // Wyświetlanie gwiazdek na podstawie oceny
            $rating = getAverageRating($cake['ID']);
            for ($i = 1; $i <= 5; $i++) {
                $rateCakeURL = 'ratecake.php?id=' . $cake['ID'];
                if ($i <= $rating) {
                    echo '<a href="' . $rateCakeURL . '"><span class="star filled"></span></a>';
                } else {
                    echo '<a href="' . $rateCakeURL . '"><span class="star unfilled"></span></a>';
                }
            }
            echo '</div>';
            echo '</div>';

            echo '<form method="post" action="addToCart.php" class="cart-form">';
            echo '<input type="hidden" name="product_id" value="' . $cake['ID'] . '">';
            echo $translationsCakedetails['quantity'] . ': <input type="number" name="quantity" value="1" min="1" max="' . $cake['Ilosc'] . '">';
            echo '<input type="submit" value="' . $translationsCakedetails['addToCart'] . '">';
            echo '</form>';
        } else {
            echo $translationsCakedetails['cakeNotFound'];
        }
    } else {
        echo $translationsCakedetails['cakeIdNotProvided'];
    }

    mysqli_close($conn);

    // Funkcja do pobrania średniej oceny dla danego ciasta
    function getAverageRating($productID)
    {
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPassword = '';
        $dbName = 'projekt_cukiernia';

        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

        if (!$conn) {
            die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
        }

        $ratingQuery = "SELECT AVG(Rating) AS averageRating FROM productreviews WHERE ProduktID = $productID";
        $ratingResult = mysqli_query($conn, $ratingQuery);

        if ($ratingResult && mysqli_num_rows($ratingResult) > 0) {
            $row = mysqli_fetch_assoc($ratingResult);
            $averageRating = $row['averageRating'];
            mysqli_free_result($ratingResult);
            mysqli_close($conn);

            if ($averageRating !== null) {
                $averageRating = round($averageRating);
            } else {
                $averageRating = 0; // Domyślna wartość, gdy brak ocen
            }

            return $averageRating;
        }

        mysqli_close($conn);

        return 0; // Domyślna wartość, gdy wystąpił błąd lub brak wyników
    }
    ?>
</div>

<?php
include_once 'footer.php';
?>