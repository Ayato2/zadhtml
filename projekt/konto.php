<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
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
    <title>Rejestracja</title>
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

    <?php if (isset($_SESSION['username'])) { ?>
        <p>Witaj, <?php echo $_SESSION['username']; ?>!</p>
        <a href="?logout">Wyloguj się</a>
        <a href="haslo.php">Zmień hasło</a>
    <?php } else { ?>
        <a href="login.php">Zaloguj się</a>
        <a href="rejestracja.php">Zarejestruj się</a>
    <?php } ?>

    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
