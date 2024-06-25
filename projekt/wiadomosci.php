<?php
session_start();
include('db.php');
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
        <h1>Wiadomosci od użytkowników</h1>
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
        <?php
        $query = "SELECT Autor, Tresc FROM Wiadomosci";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li><strong>" . $row["Autor"] . ":</strong> " . $row["Tresc"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Brak wiadomości.";
        }

        mysqli_close($conn);
        ?>
    </section>

    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
