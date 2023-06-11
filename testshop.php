<?php
    include_once 'header.php';
?>
<div class="container-cart">    
    <div class="categories">
        <ul>
            <?php
                // Połączenie z bazą danych i pobranie listy kategorii
                $dbHost = 'localhost';
                $dbUser = 'root';
                $dbPassword = '';
                $dbName = 'projekt_cukiernia';

                $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                mysqli_set_charset($conn, "utf8");

                if ($conn) {
                    $categoriesQuery = "SELECT * FROM categories";
                    $categoriesResult = mysqli_query($conn, $categoriesQuery);

                    if ($categoriesResult && mysqli_num_rows($categoriesResult) > 0) {
                        while ($category = mysqli_fetch_assoc($categoriesResult)) {
                            echo '<li><a href="cakes.php?category=' . $category['ID'] . '">' . $category['Nazwa'] . '</a></li>';
                        }
                    }
                }

                mysqli_close($conn);
            ?>
        </ul>
    </div>

    <div class="cakes10">
        <?php
		
		// Funkcja do pobrania średniej oceny dla danego ciasta
        function getAverageRating($productID) {
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

            // Połączenie z bazą danych i pobranie wszystkich ciast lub ciast danej kategorii
            $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
            mysqli_set_charset($conn, "utf8");
            if ($conn) {
                $cakesQuery = "SELECT * FROM products";

                if (isset($_GET['category'])) {
                    $categoryID = $_GET['category'];
                    $cakesQuery = "SELECT p.* FROM products AS p INNER JOIN productcategories AS pc ON p.ID = pc.ProduktID WHERE pc.KategoriaID = $categoryID";
                }

                $cakesResult = mysqli_query($conn, $cakesQuery);

                if ($cakesResult && mysqli_num_rows($cakesResult) > 0) {
                    while ($cake = mysqli_fetch_assoc($cakesResult)) {
                        echo '<div class="cake10">';
                        echo '<a href="cakedetails.php?id=' . $cake['ID'] . '">';
                        echo '<img src="' . $cake['Zdjecie'] . '" alt="' . $cake['Nazwa'] . '">';
                        echo '<h3>' . $cake['Nazwa'] . '</h3>';
                        echo '<p>Cena: ' . $cake['Cena'] . ' zł</p>';
                        echo '<p>Ilość: ' . $cake['Ilosc'] . '</p>';
                        echo '<div class="rating">';
                        echo 'Ocena: ';
                        // Wyświetlanie gwiazdek na podstawie oceny
                        $rating = getAverageRating($cake['ID']);
                        $roundedRating = round($rating); // Zaokrąglanie wartości średniej oceny
                        for ($i = 1; $i <= 5; $i++) {
							$ratecakeURL = 'ratecake.php?id=' . $cake['ID'];
                            if ($i <= $roundedRating) {
                                echo '<a href="' . $ratecakeURL . '"><span class="star filled"></span></a>';
                            } else {
                                echo '<a href="' . $ratecakeURL . '"><span class="star unfilled"></span></a>';
                            }
                        }
                        echo '</div>';
                        echo '</a>';
                        echo '<form method="post" action="addToCart.php" class="cart-form">';
                        echo '<input type="hidden" name="product_id" value="' . $cake['ID'] . '">';
                        echo 'Ilość: <input type="number" name="quantity" value="1" min="1" max="' . $cake['Ilosc'] . '">';
                        echo '<input type="submit" value="Dodaj do koszyka">';
                        echo '</form>';
                        echo '</div>';
                    }
                }
            }

            mysqli_close($conn);
        ?>
    </div>
</div>    
<?php
    include_once 'footer.php';
?>
