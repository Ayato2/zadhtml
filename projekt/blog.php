<?php
include('db.php');
session_start();





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $comment_author = isset($_SESSION['username']) ? $_SESSION['username'] : 'Gość';
    $comment_content = isset($_POST['comment_content']) ? $_POST['comment_content'] : '';

    $post_id = $_GET['id'];
    $insert_query = "INSERT INTO komentarze (ID_Artykulu, Autor, Tresc) VALUES ($post_id, '$comment_author', '$comment_content')";

    if (mysqli_query($conn, $insert_query)) {
        echo "Komentarz został dodany!";
    } else {
        echo "Błąd przy dodawaniu komentarza: " . mysqli_error($conn);
    }

    header("Location: blog.php?id=$post_id");
    exit;
}
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
        <?php
        if (isset($_GET['id'])) {
            $post_id = $_GET['id'];
            $query = "SELECT * FROM blog WHERE ID = $post_id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $post_title = $row['Nazwa'];
                $cat = $row['Kategoria'];
                $content = isset($row['Tresc']) ? $row['Tresc'] : 'Brak treści';
                $date_added = $row['DataDodania'];

                echo "<h1>$post_title</h1>";
                if (isset($_SESSION['username']) && $_SESSION['admin'] === 1) {
                    echo "<p>ID: $post_id</p>";
                }
                echo "<p>Kategoria: $cat</p>";
                echo "<p>Data dodania: $date_added</p>";
                echo "<p>$content</p>";

                $comments_query = "SELECT * FROM komentarze WHERE ID_Artykulu = $post_id";
                $comments_result = mysqli_query($conn, $comments_query);

                if (mysqli_num_rows($comments_result) > 0) {
                    echo "<h2>Komentarze:</h2>";
                    while ($comment_row = mysqli_fetch_assoc($comments_result)) {
                        $comment_author = $comment_row['Autor'];
                        $comment_content = $comment_row['Tresc'];
                        $comment_date = $comment_row['DataDodania'];

                        echo "<p><strong>$comment_author</strong> ($comment_date): $comment_content</p>";
                    }
                } else {
                    echo "<p>Brak komentarzy.</p>";
                }
                echo "<h2>Dodaj komentarz:</h2>";
                echo "<form method=\"post\">";
                echo "<textarea name=\"comment_content\" placeholder=\"Treść komentarza\"></textarea>";
                echo "<input type=\"submit\" value=\"Dodaj komentarz\">";
                echo "</form>";
            } else {
                echo "Artykuł nie istnieje.";
            }
        } else {
            echo "Nieprawidłowe parametry URL.";
        }

        mysqli_close($conn);
        ?>
    </div>

    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
