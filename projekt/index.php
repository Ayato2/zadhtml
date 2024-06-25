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

    <div class="content">
        <section>
            <?php
            $query = "SELECT ID, Nazwa, Kategoria FROM blog ORDER BY ID DESC LIMIT 4";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['ID'];
                    $post_title = $row['Nazwa'];
                    $cat = $row['Kategoria'];

                    echo "<article>";
                    echo "<h2><a href='blog.php?id=$post_id'>$post_title</a></h2>";
                    echo "<p>Kategoria: $cat</p>";
                    echo "</article>";
                }
            } else {
                echo "Brak wpisów.";
            }

            mysqli_close($conn);
            ?>
        </section>

    </div>

    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>