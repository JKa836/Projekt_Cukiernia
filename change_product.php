<?php
include_once 'headerpracownik.php';
?>

<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt_cukiernia";

$connection = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($connection, "utf8");
if (!$connection) {
    die("Nieudane połączenie z bazą danych: " . mysqli_connect_error());
}
mysqli_set_charset($connection, "utf8");

// Aktualizacja dostępności produktu po wysłaniu formularza
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $availability = $_POST['availability'];

    $update_query = "UPDATE products SET Ilosc = '$availability' WHERE ID = '$product_id'";
    mysqli_query($connection, $update_query);

    // Przekierowanie na tę samą stronę, ale jako żądanie GET
    header("Location: ".$_SERVER['PHP_SELF']);
    exit(); // Zakończenie skryptu
}

// Aktualizacja ceny produktu po wysłaniu formularza
if (isset($_POST['update_price'])) {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];

    $update_query = "UPDATE products SET Cena = '$price' WHERE ID = '$product_id'";
    mysqli_query($connection, $update_query);

    // Przekierowanie na tę samą stronę, ale jako żądanie GET
    header("Location: ".$_SERVER['PHP_SELF']);
    exit(); // Zakończenie skryptu
}
?>

<div class="container">
    <div class="cart-items">
        <?php
        // Pobranie danych wszystkich produktów
        $query = "SELECT * FROM products";
        $result = mysqli_query($connection, $query);
        ?>

        <table>
            <tr>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Akcje</th>
                <th>Cena</th>
                <th>Akcje</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Nazwa'] . "</td>";
                echo "<td style='text-align: center;'>" . $row['Ilosc'] . "</td>";
                echo "<td>
                    <form action='".$_SERVER['PHP_SELF']."' method='POST'>
                        <input type='hidden' name='product_id' value='" . $row['ID'] . "'>
                        <input type='number' step='1' name='availability' value='" . $row['Ilosc'] . "' min='0'>
                        <button type='submit' name='update_product' class='update-button'>Aktualizuj</button>
                    </form>
                </td>";
                echo "<td>" . $row['Cena'] . " zł</td>";
                echo "<td>
                    <form action='".$_SERVER['PHP_SELF']."' method='POST'>
                        <input type='hidden' name='product_id' value='" . $row['ID'] . "'>
                        <input type='number' step='0.01' name='price' value='" . $row['Cena'] . "' min='0'>
                        <button type='submit' name='update_price' class='update-button'>Aktualizuj</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php
// Zamykanie połączenia z bazą danych
mysqli_close($connection);
include_once 'footer.php';
?>