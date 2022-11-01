<?php
session_start();
// check login & password
if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
    if ($_SESSION['login'] != 'log' && $_SESSION['password'] != 'pass') {
        header('location: admin.php');
        exit;
    }
} else {
    header('location: admin.php');
    exit;
}
// DB connection
require_once('../inc/connect.php');
// get page
if (isset($_GET['page']) && file_exists('inc/pages/'.$_GET['page'].'.php')) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
// page data
if ($page != 'item') {
    $sql = mysqli_query($con, "SELECT * FROM `pages` WHERE `name`='$page'");
    $row = mysqli_fetch_assoc($sql);
    $title = $row['title'];
    $meta_d = $row['meta_d'];
    $descr = $row['descr'];
} else {
    // get id
    $id = $_GET['id'];
    // get data
    $sql = mysqli_query($con, "SELECT * FROM `news` WHERE `id`='$id'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $title = $row['title'];
        $meta_d = mb_substr($row['descr'], 0, 140).'...';
        $descr = $row['descr'];
        // img
        if ($row['img'] == '') {
            $img = 'no_photo.jpg';
        } else {
            $img = $row['img'];
        }
    } else {
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header"></div>
            <div id="container">
                <div id="side" class="white">
                    <div class="nav">
                        <h3>Մենյու</h3>
                        <ul>
                            <li><a href="index.php">Գլխավոր</a></li>
                            <li><a href="?page=news" <?php if ($page == 'news') {?>class="active"<?php }?>>Նորություններ</a></li>
                            <li><a href="?page=add_news" <?php if ($page == 'add_news') {?>class="active"<?php }?>>Ավելացնել նորություն</a></li>
                            <li><a href="?page=about" <?php if ($page == 'about') {?>class="active"<?php }?>>Մեր մասին</a></li>
                            <li><a href="?page=feedback" <?php if ($page == 'feedback') {?>class="active"<?php }?>>Հետադարձ կապ</a></li>
                            <li><a href="inc/conf.php?cmd=exit" style="color:#CD000D">Դուրս գալ</a></li>
                        </ul>
                    </div>
                </div>
                <div id="content" class="white">
                    <?php include_once('inc/pages/'.$page.'.php'); ?>
                </div>
            </div>
        </div>
    </body>
</html>