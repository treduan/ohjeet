<?php
    require "header.php";
?>

<form method="post">
    <label for="amount">Anna euromäärä:</label>
    <input type="text" id="amount" name="amount" required>
    <button type="submit">Lähetä</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ota käyttäjän syöttämä arvo vastaan
    $amount = $_POST['amount'];

    // Muuta pilkku pisteeksi
    $amount = str_replace(',', '.', $amount);
    echo $amount;

    // Varmista, että arvo on numeroksi kelpaava
    if (is_numeric($amount)) {
        // Tee laskutoimituksia
        $summa = $amount * 2; // Esimerkki: kaksinkertaistetaan arvo

        echo "Alkuperäinen summa: " . htmlspecialchars($_POST['amount']) . "<br>";
        echo "Muunnettuna: $amount<br>";
        echo "Kaksinkertaistettuna: $summa";
    } else {
        echo "Syötä kelvollinen luku.";
    }
}
?>


<?php
    require "footer.php";
?>