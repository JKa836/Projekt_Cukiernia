<?php
    include_once 'header.php';
?>

<div class="container-cart">
    <div class="cart-items">

<?php

// Sprawdzenie, czy koszyk jest pusty
if (empty($_SESSION['cart'])) {
    echo 'Koszyk jest pusty.';
} else {
    // Połączenie z bazą danych
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($conn, "utf8");
    if (!$conn) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    // Pobranie danych produktów z koszyka
    $productIDs = array_keys($_SESSION['cart']);
    $productIDsString = implode(',', $productIDs);

    $query = "SELECT * FROM products WHERE ID IN ($productIDsString)";
    $result = mysqli_query($conn, $query);

    // Inicjalizacja zmiennej przechowującej łączną cenę zamówienia
    $totalPrice = 0;

// Sprawdzenie, czy są produkty w koszyku
    if ($result && mysqli_num_rows($result) > 0) {
        // Wyświetlanie zawartości koszyka
        echo '<h2>Koszyk</h2>';
        echo '<table>';
        echo '<tr><th>Nazwa</th><th>Cena</th><th>Ilość</th><th>Usuń rzecz</th></tr>';

    while ($product = mysqli_fetch_assoc($result)) {
        $productID = $product['ID'];
        $productName = $product['Nazwa'];
        $productPrice = $product['Cena'];
        $productQuantity = $_SESSION['cart'][$productID];

        // Obliczanie częściowej ceny dla danego produktu
        $partialPrice = $productPrice * $productQuantity;

        // Dodawanie częściowej ceny do łącznej ceny zamówienia
        $totalPrice += $partialPrice;

        echo '<tr>';
        echo '<td>' . $productName . '</td>';
        echo '<td>' . $productPrice . ' zł</td>';
        echo '<td>' . $productQuantity . '</td>';
        echo '<td><a href="cart.php?remove_from_cart=' . $productID . '">Usuń</a></td>';
        echo '</tr>';
    }

    echo '</table>';

    // Wyświetlanie łącznej ceny zamówienia
    echo '<h3>Łączna cena zamówienia: ' . $totalPrice . ' zł</h3>';
    
 
    // Sprawdzenie, czy został wysłany parametr remove_from_cart
    if (isset($_GET['remove_from_cart'])) {
        $removeProductID = $_GET['remove_from_cart'];

        // Usunięcie produktu z koszyka
        unset($_SESSION['cart'][$removeProductID]);

        // Przekierowanie z powrotem do strony koszyka
        header("Location: cart.php");
        exit();
    }
} else {
    echo 'Brak produktów w koszyku.';
}

    mysqli_close($conn);
}
?>
</div>
    <div class="shipping-form">
      <h2>Dane dostawy</h2>
      <form action="placeOrder.php" method="POST">
        <div>
          <label for="street">Ulica:</label>
          <input type="text" id="street" name="street" required autocomplete="off">
        </div>
        <div>
          <label for="apartment_number">Numer mieszkania:</label>
          <input type="text" id="apartment_number" name="apartment_number" required autocomplete="off">
        </div>
        <div>
          <label for="city">Miasto:</label>
          <input type="text" id="city" name="city" required autocomplete="off">
        </div>
        <div>
          <label for="province">Województwo:</label>
          <input type="text" id="province" name="province" required autocomplete="off">
        </div>
        <div>
          <label for="postal_code">Kod pocztowy:</label>
          <input type="text" id="postal_code" name="postal_code" required autocomplete="off">
        </div>
        <button type="submit">Zamów teraz</button>
      </form>
    </div>
  </div>
<?php
    include_once 'footer.php';
?>