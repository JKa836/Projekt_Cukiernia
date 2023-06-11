<?php
$servername = "localhost";  // Nazwa hosta (np. localhost)
$username = "root";    // Nazwa użytkownika bazy danych
$password = "";    // Hasło użytkownika bazy danych
$dbname = "projekt_cukiernia";      // Nazwa bazy danych

// Tworzenie połączenia z bazą danych
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Sprawdzanie czy połączenie zostało ustanowione
if (!$connection) {
    die("Nieudane połączenie z bazą danych: " . mysqli_connect_error());
}

$imie = 'Jan';
$nazwisko = 'Test';
$email = 'jantest@poczta.pl';
$haslo = password_hash('zaq12wsx', PASSWORD_DEFAULT); // Haszowanie hasła

// Zapytanie SQL do dodania pracownika
$query = "INSERT INTO employees (Imie, Nazwisko, Email, Haslo) 
          VALUES ('$imie', '$nazwisko', '$email', '$haslo')";

if (mysqli_query($connection, $query)) {
    echo "Pracownik został dodany.";
} else {
    echo "Wystąpił błąd podczas dodawania pracownika: " . mysqli_error($connection);
}

// Zamykanie połączenia z bazą danych
mysqli_close($connection);
?>
