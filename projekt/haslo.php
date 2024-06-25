<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username'];

    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $hashed_password_from_db = $row['password'];


    if (password_verify($old_password, $hashed_password_from_db)) {

        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password = ? WHERE username = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ss", $hashed_new_password, $username);
        $update_stmt->execute();


        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        $error_message = "Nieprawidłowe stare hasło. Spróbuj ponownie.";
    }

    $stmt->close();
    $update_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Zmień hasło</title>
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
        <label for="old_password">Stare hasło:</label>
        <input type="password" name="old_password" id="old_password" required>

        <label for="new_password">Nowe hasło:</label>
        <input type="password" name="new_password" id="new_password" required>

        <input type="submit" value="Zmień hasło">
    </form>

    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
