<?php
// Połączenie z bazą danych
    session_start();

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'projekt_cukiernia';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die('Błąd połączenia z bazą danych: ' . mysqli_connect_error());
}

// Sprawdzenie czy dane z formularza zostały przesłane
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $street = $_POST['street'];
    $apartmentNumber = $_POST['apartment_number'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalCode = $_POST['postal_code'];

    // Zapytanie SQL w celu dodania zamówienia do tabeli orderdetails
    $orderQuery = "INSERT INTO orderdetails (ZamowienieID, ProduktID, Ilosc, Cena) VALUES (?, ?, ?, ?)";
    $orderStatement = mysqli_prepare($conn, $orderQuery);

    // Pobranie unikalnego identyfikatora zamówienia
    $orderID = uniqid();

    // Iteracja przez produkty w koszyku i dodanie ich do zamówienia
    // Dodanie produktów do tabeli orderdetails
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

        // Zmniejszenie ilości produktu w tabeli products
        $updateProductQuery = "UPDATE products SET Ilosc = Ilosc - ? WHERE ID = ?";
        $updateProductStatement = mysqli_prepare($conn, $updateProductQuery);
        mysqli_stmt_bind_param($updateProductStatement, 'ii', $quantity, $productID);
        mysqli_stmt_execute($updateProductStatement);
        mysqli_stmt_close($updateProductStatement);
}

    // Dodanie danych do tabeli shipping
    $street = $_POST['street'];
    $apartmentNumber = $_POST['apartment_number'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalCode = $_POST['postal_code'];

    $shippingQuery = "INSERT INTO shipping (ZamowienieID, Ulica_nr, Nr_mieszkania, Miasto, Wojewodztwo, KodPocztowy) VALUES (?, ?, ?, ?, ?, ?)";
    $shippingStatement = mysqli_prepare($conn, $shippingQuery);
    mysqli_stmt_bind_param($shippingStatement, 'isssss', $orderID, $street, $apartmentNumber, $city, $province, $postalCode);
    mysqli_stmt_execute($shippingStatement);
    mysqli_stmt_close($shippingStatement);

    // Wyczyszczenie koszyka
    $_SESSION['cart'] = [];

    // Przekierowanie na stronę potwierdzenia zamówienia
    header('Location: confirmation.php');
    exit;
}    
?>
