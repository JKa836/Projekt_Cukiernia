<?php include_once 'headerpracownik.php'; ?>
<div class="container">
    <div class="cart-items">
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
        // Zapytanie SQL do pobrania danych zamówień
        $query = "SELECT orders.ID, customers.Imie, customers.Nazwisko, orders.DataZamowienia
                  FROM orders
                  INNER JOIN customers ON orders.KlientID = customers.ID";
        $result = mysqli_query($connection, $query);

        // Wyświetlanie tabeli z zamówieniami i generowanie etykiet
        echo "<table>";
        echo "<tr><th>Zamówienie</th><th>Klient</th><th>Data zamówienia</th><th>Etykieta</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Imie'] . " " . $row['Nazwisko'] . "</td>";
            echo "<td>" . $row['DataZamowienia'] . "</td>";
            echo "<td><a href='generate_label.php?order_id=" . $row['ID'] . "'>Generuj etykietę</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        // Zamykanie połączenia z bazą danych
        mysqli_close($connection);
        ?>
</div>
</div>
<?php include_once 'footer.php'; ?>