<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GameHunters</title>
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

    <section>
        <h2>Kategorie</h2>
        <div class="categories">
            <ul>
                <li><a href="nowosc.php">Nowość</a></li>
                <li><a href="przecena.php">Przecena</a></li>
                <li><a href="pricebug.php">Pricebug</a></li>
                <li><a href="konsola.php">Konsola</a></li>
                <li><a href="lego.php">Lego</a></li>
            </ul>
        </div>
    </section>

    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
