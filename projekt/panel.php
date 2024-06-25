<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['admin'] !== 1) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Panel administracyjny</title>
</head>
<body>
    <header>
        <h1>Panel administracyjny</h1>
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
                <a href="dodanie.php">Dodaj wpis</a>
                <a href="edycja.php">Edytuj wpis</a>
                <a href="usuwanie.php">Usuń wpis</a>
                <a href="wiadomosci.php">Wiadomości</a>
    
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>