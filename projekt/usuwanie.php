<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];

    $comments_query = "DELETE FROM komentarze WHERE ID_Artykulu = $post_id";
    mysqli_query($conn, $comments_query);

    $article_query = "DELETE FROM blog WHERE ID = $post_id";
    mysqli_query($conn, $article_query);

    header("Location: panel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Usuwanie artykułu</title>
</head>
<body>
<header>
        <h1>Usuń artykuł</h1>
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
        <label for="post_id">ID artykułu:</label>
        <input type="number" name="post_id" id="post_id" required>

        <input type="submit" value="Usuń artykuł">
    </form>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
