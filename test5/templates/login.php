<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once '../classes/User.php';
    $user = new User();
    $loginResult = $user->login($username, $password);

    if ($loginResult) {
        $_SESSION['usuario'] = $username;
        header('Location: ../index.php ');
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">

    <title>login</title>
</head>

<body>
    <div class="login">
        <h2>Iniciar sesión</h2>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Iniciar sesión</button>
        </form>
    </div>
</body>

</html>