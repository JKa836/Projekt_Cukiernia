<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt_cukiernia";
$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Pobranie identyfikatora zamówienia z parametru URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Zapytanie SQL do pobrania danych zamówienia, danych klienta, danych dostawy i szczegółów zamówienia
    $query = "SELECT orders.ID AS OrderID, customers.Imie, customers.Nazwisko, customers.Email, orders.DataZamowienia,
              orderdetails.ProduktID, orderdetails.Ilosc, orderdetails.Cena,
              products.Nazwa AS NazwaProduktu,
              shipping.Ulica_nr, shipping.Nr_mieszkania, shipping.Miasto, shipping.Wojewodztwo, shipping.KodPocztowy
              FROM orders
              INNER JOIN customers ON orders.KlientID = customers.ID
              INNER JOIN orderdetails ON orders.ID = orderdetails.ZamowienieID
              INNER JOIN products ON orderdetails.ProduktID = products.ID
              INNER JOIN shipping ON orders.ID = shipping.ZamowienieID
              WHERE orders.ID = '$order_id'";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Pobranie danych zamówienia
        $row = mysqli_fetch_assoc($result);
        $order_id = $row['OrderID'];
        $customer_name = $row['Imie'] . ' ' . $row['Nazwisko'];
        $customer_email = $row['Email'];
        $order_date = $row['DataZamowienia'];
        $delivery_address = $row['Ulica_nr'] . ', ' . $row['Nr_mieszkania'] . ', ' . $row['KodPocztowy'] . ' ' . $row['Miasto'] . ', ' . $row['Wojewodztwo'];

        // Generowanie etykiety zamówienia przy użyciu TCPDF
        require_once('TCPDF-main/tcpdf.php');

        // Utworzenie nowego obiektu TCPDF
        $pdf = new TCPDF();

        // Konfiguracja dokumentu PDF
        $pdf->SetTitle('Etykieta zamówienia');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Ustawienie kodowania UTF-8
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 12, '', true);

        // Generowanie zawartości etykiety
        $bakery_header = '<table>
                            <tr>
                                <td style="vertical-align: top;">
                                    <strong>Dane cukierni:</strong><br>
                                    Telefon: 123-456-789<br>
                                    Email: kontakt@cukiernia.pl<br>
                                    Adres: ul. Słodkiej 10, 00-000 Miasteczko
                                </td>
                                <td style="text-align: right;">
                                    <img src="img/logo2.png" alt="Logo Firmy" width="150">
                                </td>
                            </tr>
                        </table>';

        // Generowanie etykiety zamówienia
        $pdf->writeHTML($bakery_header, true, false, true, false, '');

        $pdf->Ln(10); // Dodanie odstępu

        $content = '<strong>Numer zamówienia:</strong> ' . $order_id . '<br><br>';
        $content .= '<strong>Dane klienta:</strong><br>';
        $content .= '<strong>Imię i nazwisko:</strong> ' . $customer_name . '<br>';
        $content .= '<strong>Email:</strong> ' . $customer_email . '<br><br>';
        $content .= '<strong>Dane dostawy:</strong><br>';
        $content .= $delivery_address . '<br><br>';
        $content .= '<strong>Data zamówienia:</strong> ' . $order_date . '<br><br>';
        $content .= '<strong>Szczegóły zamówienia:</strong><br><br>';

        // Generowanie tabeli ze szczegółami zamówienia
        $content .= '<table border="1" cellpadding="5">
                        <tr>
                            <th>Produkt</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                        </tr>';

        $total_price = 0; // Inicjalizacja sumy ceny zamówienia

        // Pobieranie szczegółów zamówienia
        mysqli_data_seek($result, 0); // Przewijanie kursora do początku wyników
        while ($row = mysqli_fetch_assoc($result)) {
            $product_name = $row['NazwaProduktu'];
            $quantity = $row['Ilosc'];
            $price = $row['Cena'];

            $content .= '<tr>
                            <td>' . $product_name . '</td>
                            <td>' . $quantity . '</td>
                            <td>' . $price . ' zł</td>
                        </tr>';

            $total_price += $price; // Dodawanie ceny produktu do sumy ceny zamówienia
        }

        $content .= '</table>';

        // Dodanie informacji o finalnej cenie zamówienia
        $content .= '<br><br><strong>Suma zamówienia:</strong> ' . $total_price . ' zł';

        // Generowanie kodu kreskowego
        $barcode = $order_id;

        // Dodanie kodu kreskowego do zawartości etykiety
        $content .= '<br><br><strong>Kod zamówienia:</strong><br><br>';
        $content .= '<span style="font-family: code128">' . $barcode . '</span>';

        // Dodanie zawartości do dokumentu PDF
        $pdf->writeHTML($content, true, false, true, false, '');

        // Wygenerowanie pliku PDF z kodowaniem UTF-8
        $pdf->Output('etykieta_zamowienia.pdf', 'D');
        exit;
    } else {
        echo "Nie znaleziono zamówienia o podanym identyfikatorze.";
    }
} else {
    echo "Brak identyfikatora zamówienia.";
}

// Zamykanie połączenia z bazą danych
mysqli_close($connection);
?>
