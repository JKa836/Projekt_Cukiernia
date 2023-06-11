<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Pobranie identyfikatora klienta z sesji
$userID = $_SESSION['user_id'];

// Sprawdzenie, czy koszyk jest pusty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Połączenie z bazą danych
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

    if (!$conn) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

// Rozpoczęcie transakcji
mysqli_begin_transaction($conn);

try {
    // Dodanie zamówienia do tabeli "orders"
    $orderQuery = "INSERT INTO orders (KlientID, DataZamowienia) VALUES (?, NOW())";
    $orderStatement = mysqli_prepare($conn, $orderQuery);
    mysqli_stmt_bind_param($orderStatement, 'i', $userID);
    mysqli_stmt_execute($orderStatement);
    $orderID = mysqli_insert_id($conn);
    mysqli_stmt_close($orderStatement);

    // Iteracja przez produkty w koszyku i dodanie ich do zamówienia
    foreach ($_SESSION['cart'] as $productID => $quantity) {
        $productQuery = "SELECT Cena FROM products WHERE ID = ?";
        $productStatement = mysqli_prepare($conn, $productQuery);
        mysqli_stmt_bind_param($productStatement, 'i', $productID);
        mysqli_stmt_execute($productStatement);
        mysqli_stmt_bind_result($productStatement, $productPrice);
        mysqli_stmt_fetch($productStatement);
        mysqli_stmt_close($productStatement);

        $orderDetailsQuery = "INSERT INTO orderdetails (ZamowienieID, ProduktID, Ilosc, Cena) VALUES (?, ?, ?, ?)";
        $orderDetailsStatement = mysqli_prepare($conn, $orderDetailsQuery);
        mysqli_stmt_bind_param($orderDetailsStatement, 'iiid', $orderID, $productID, $quantity, $productPrice);
        mysqli_stmt_execute($orderDetailsStatement);
        mysqli_stmt_close($orderDetailsStatement);

        // Aktualizacja ilości produktu w tabeli "products"
        $updateQuantityQuery = "UPDATE products SET Ilosc = Ilosc - ? WHERE ID = ?";
        $updateQuantityStatement = mysqli_prepare($conn, $updateQuantityQuery);
        mysqli_stmt_bind_param($updateQuantityStatement, 'ii', $quantity, $productID);
        mysqli_stmt_execute($updateQuantityStatement);
        mysqli_stmt_close($updateQuantityStatement);
    }

    // Dodanie danych wysyłki do tabeli "shipping"
    $streetNumber = $_POST['street'];
    $apartmentNumber = $_POST['apartment_number'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalCode = $_POST['postal_code'];

    $shippingQuery = "INSERT INTO shipping (ZamowienieID, Ulica_nr, Nr_mieszkania, Miasto, Wojewodztwo, KodPocztowy) VALUES (?, ?, ?, ?, ?, ?)";
    $shippingStatement = mysqli_prepare($conn, $shippingQuery);
    mysqli_stmt_bind_param($shippingStatement, 'isssss', $orderID, $streetNumber, $apartmentNumber, $city, $province, $postalCode);
    mysqli_stmt_execute($shippingStatement);
    mysqli_stmt_close($shippingStatement);

    // Zatwierdzenie transakcji
    mysqli_commit($conn);

    // Wyczyszczenie koszyka
    unset($_SESSION['cart']);

    // Przekierowanie na stronę potwierdzenia zamówienia
    header('Location: confirmation.php');
    exit();

} catch (Exception $e) {
    // Błąd transakcji - cofnięcie zmian
    mysqli_rollback($conn);
    die('Wystąpił błąd podczas składania zamówienia: ' . $e->getMessage());
}
?>
