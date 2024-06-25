<?php
session_start();


if (!isset($_SESSION['username'])) {
    echo "Musisz być zalogowany, żeby skontaktować się z administratorem.";
    exit;
}


if ($_SESSION['admin'] === 1) {
    echo "Aby sprawdzić wiadomości wysłane do ciebie, wejdź do panelu administracyjnego.";
    exit;
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_SESSION['username'];
    $message_content = $_POST['message_content'];


    $insert_query = "INSERT INTO Wiadomosci (Autor, Tresc) VALUES ('$author', '$message_content')";

    if (mysqli_query($conn, $insert_query)) {

    } else {
        echo "Błąd przy wysyłaniu wiadomości: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kontakt z administratorem</title>
</head>
<body>
<header>
        <h1>GameHunters</h1>
    </header>
<nav>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="kategorie.php">Kategorie</a></li>
            <li><a href="omnie.php">O mnie</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="konto.php">Konto</a></li>
            <?php if (isset($_SESSION['username']) && $_SESSION['admin'] === 1) { ?>
                <li><a href="panel.php">Panel administracyjny</a></li>
            <?php } ?>
        </ul>
    </nav>

    <form method="post">
        <label for="message_content">Treść wiadomości:</label>
        <textarea name="message_content" id="message_content" rows="10" required></textarea>

        <input type="submit" value="Utwórz wiadomość">
    </form>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
