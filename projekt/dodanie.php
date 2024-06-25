<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_title = $_POST['post_title'];
    $post_category = $_POST['post_category'];
    $post_content = $_POST['post_content'];


    $insert_query = "INSERT INTO blog (Nazwa, Kategoria, Tresc) VALUES ('$post_title', '$post_category', '$post_content')";

    if (mysqli_query($conn, $insert_query)) {
        echo "Artykuł został dodany!";
    } else {
        echo "Błąd przy dodawaniu artykułu: " . mysqli_error($conn);
    }


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
    <title>Dodaj artykuł</title>
</head>
<body>
<header>
        <h1>Dodaj artykuł</h1>
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
        <label for="post_title">Tytuł:</label>
        <input type="text" name="post_title" id="post_title" required>

        <label for="post_category">Kategoria:</label>
        <select name="post_category" id="post_category" required>
            <option value="Przecena">Przecena</option>
            <option value="PriceBug">PriceBug</option>
            <option value="Nowość">Nowość</option>
            <option value="Konsola">Konsola</option>
            <option value="Lego">Lego</option>
        </select>

        <label for="post_content">Treść:</label>
        <textarea name="post_content" id="post_content" rows="10" required></textarea>

        <input type="submit" value="Wstaw artykuł">
    </form>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
