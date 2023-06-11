<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt_cukiernia";
$connection = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($connection, "utf8");
if (!$connection) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Pobranie listy kategorii ciast z bazy danych
$query = "SELECT ID, Nazwa FROM categories";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Błąd podczas pobierania kategorii z bazy danych: " . mysqli_error($connection));
}

// Przygotowanie tablicy z danymi kategorii
$kategorie = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kategorie[$row['ID']] = $row['Nazwa'];
}

// Zdefiniowanie początkowej wartości zmiennej komunikatu
$komunikat = "";

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Wczytanie danych z formularza
    $ciasto_nazwa = $_POST['nazwa'];
    $ciasto_opis = $_POST['opis'];
    $ciasto_cena = $_POST['cena'];
    $ciasto_zdjecie = $_POST['zdjecie'];
    $ciasto_ilosc = $_POST['ilosc'];
    $kategoria_id = $_POST['kategoria'];

    // Wstawianie ciasta do bazy danych
    $query = "INSERT INTO products (Nazwa, Opis, Cena, Zdjecie, Ilosc) VALUES ('$ciasto_nazwa', '$ciasto_opis', $ciasto_cena, '$ciasto_zdjecie', $ciasto_ilosc)";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Pobranie ID dodanego ciasta
        $ciasto_id = mysqli_insert_id($connection);

        // Sprawdzenie, czy wybrano poprawną kategorię
        if (isset($kategorie[$kategoria_id])) {
            // Wstawianie przypisania ciasta do kategorii
            $query = "INSERT INTO productcategories (ProduktID, KategoriaID) VALUES ($ciasto_id, $kategoria_id)";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $komunikat = "Dodano ciasto do bazy danych i przypisano do kategorii.";
            } else {
                $komunikat = "Błąd podczas przypisywania ciasta do kategorii: " . mysqli_error($connection);
            }
        } else {
            $komunikat = "Wybrano nieprawidłową kategorię.";
        }
    } else {
        $komunikat = "Błąd podczas dodawania ciasta do bazy danych: " . mysqli_error($connection);
    }
}

// Zamykanie połączenia z bazą danych
mysqli_close($connection);
?>

<?php include_once 'headerpracownik.php'; ?>
<div class="container">     
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="addproduct-form">
        <h1>Dodaj ciasto</h1>
        <label for="nazwa">Nazwa ciasta:</label>
        <input type="text" name="nazwa" required autocomplete="off"><br>

        <label for="opis">Opis ciasta:</label>
        <textarea name="opis" required autocomplete="off"></textarea><br>

        <label for="cena">Cena ciasta:</label>
        <input type="number" name="cena" step="0.01" required autocomplete="off"><br>

        <label for="zdjecie">Ścieżka do zdjęcia:</label>
        <input type="text" name="zdjecie" required autocomplete="off"><br>

        <label for="ilosc">Ilość dostępna:</label>
        <input type="number" name="ilosc" required autocomplete="off"><br>

        <label for="kategoria">Kategoria:</label>
        <select name="kategoria" required>
            <?php foreach ($kategorie as $id => $nazwa) { ?>
                <option value="<?php echo $id; ?>"><?php echo $nazwa; ?></option>
            <?php } ?>
        </select><br>

        <input type="submit" value="Dodaj ciasto">
        <span class="success-heading">
        <?php if (!empty($komunikat)) { ?>
            <p><?php echo $komunikat; ?></p>
        <?php } ?>
        </span>      
    </form>
    
    
</div>
<?php include_once 'footer.php'; ?>
