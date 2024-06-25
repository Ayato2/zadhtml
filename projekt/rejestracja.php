<?php
include('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $username, $hashed_password, $email);


    if ($sql->execute()) {

        header("Location: konto.php");
        exit;
    } else {
        echo "Błąd: " . $sql->error;
    }


    $sql->close();
    $conn->close();
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
    <form method="post" action="rejestracja.php">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Adres email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Zarejestruj">
    </form>
    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>



