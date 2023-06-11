<?php
session_start();

// Sprawdzenie, czy produkt i ilość zostały przesłane
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productID = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Dodanie produktu do koszyka
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Dodanie produktu do tablicy koszyka w sesji
    $_SESSION['cart'][$productID] = $quantity;

    // Przekierowanie użytkownika z powrotem do strony z ciastami
    header("Location: testshop.php");
    exit();
}
