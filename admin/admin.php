<?php
session_start();
// login
if (isset($_POST['login']) && isset($_POST['password'])) {
    // login & password
    $log = 'log';
    $pass = 'pass';
    // check login
    if ($_POST['login'] == $log && $_POST['password'] == $pass) {
        $_SESSION['login'] = $log;
        $_SESSION['password'] = $pass;
        header('location: index.php');
        exit;
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ադմինիստրացիոն համակարգ</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div id="admin" class="white">
            <h3>Ադմինիստրացիոն համակարգ</h3>
            <form action="admin.php" method="post">
                <p><input type="text" name="login" placeholder="Login"></p>
                <p><input type="password" name="password" placeholder="Password"></p>
                <p><button type="submit">Մուտք</button></p>
            </form>
        </div>
    </body>
</html>