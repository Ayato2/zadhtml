<?php


include('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['password'];
        $admin_value = $row['admin'];

        if (password_verify($password, $hashed_password_from_db)) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $admin_value;
            header("Location: konto.php");
            exit;
        } else {
            $error_message = "Nieprawidłowe dane logowania. Spróbuj ponownie.";
        }
    } else {
        $error_message = "Nieprawidłowe dane logowania. Spróbuj ponownie.";
    }

    $stmt->close();
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

    <form action="login.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <section>
            <input type="submit" name="submit" value="Login">
            <a href="rejestracja.php">Register</a>
        </section>
        <?php if (isset($error_message)) { ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php } ?>
    </form>
    <footer>
        <p>© s30131</p>
    </footer>
</body>
</html>
