<?php
session_start();
// DB connection
require_once('../../inc/connect.php');
require_once('simpleImage.php');
// edit page
if ($_GET['cmd'] == 'edit_page') {
    $page = $_GET['page'];
    $meta_d = trim(htmlspecialchars($_POST['meta_d']));
    $descr = trim(htmlspecialchars($_POST['descr']));
    // update
    $update = mysqli_query($con, "UPDATE `pages` SET `meta_d`='$meta_d', `descr`='$descr' WHERE `name`='$page'");
    // result
    if ($update) {
        header('location: ../index.php?page='.$page.'&result=1');
    } else {
        header('location: ../index.php?page='.$page.'&result=0');
    }
    exit;
}
// add news
if ($_GET['cmd'] == 'add_news') {
    $title = trim(htmlspecialchars($_POST['title']));
    $descr = trim(htmlspecialchars($_POST['descr']));
    $img = '';
    // add
    $add = mysqli_query($con, "INSERT INTO `news` (`title`, `descr`, `img`, `date`) VALUES ('$title', '$descr', '$img', now())");
    // get id
    $id = mysqli_insert_id($con);
    // img
    if ($_FILES['img']['size'] > 0) {
        $img = $id.'.jpg';
        $image = new SimpleImage();
        // thumbs
        $image->load($_FILES['img']['tmp_name']);
        $image->crop(130, 130);
        $image->save('../../photos/news/thumbs/'.$img.'');
        // large
        $image->load($_FILES['img']['tmp_name']);
        $image->resizeToWidth(660);
        $image->save('../../photos/news/large/'.$img.'');
        // update
        mysqli_query($con, "UPDATE `news` SET `img`='$img' WHERE `id`='$id'");
    }
    // result
    if ($add) {
        header('location: ../index.php?page=news&result=1');
    } else {
        header('location: ../index.php?page=news&result=0');
    }
    exit;
}
// edit news
if ($_GET['cmd'] == 'edit_news') {
    $id = $_GET['id'];
    $title = trim(htmlspecialchars($_POST['title']));
    $descr = trim(htmlspecialchars($_POST['descr']));
    // img
    if ($_FILES['img']['size'] > 0) {
        $img = $id.'.jpg';
        $image = new SimpleImage();
        // thumbs
        $image->load($_FILES['img']['tmp_name']);
        $image->crop(130, 130);
        $image->save('../../photos/news/thumbs/'.$img.'');
        // large
        $image->load($_FILES['img']['tmp_name']);
        $image->resizeToWidth(660);
        $image->save('../../photos/news/large/'.$img.'');
        // update
        mysqli_query($con, "UPDATE `news` SET `img`='$img' WHERE `id`='$id'");
    }
    // update
    $update = mysqli_query($con, "UPDATE `news` SET `title`='$title', `descr`='$descr' WHERE `id`='$id'");
    // result
    if ($update) {
        header('location: ../index.php?page=news&result=1');
    } else {
        header('location: ../index.php?page=news&result=0');
    }
    exit;
}
// delete news
if ($_GET['cmd'] == 'delete_news') {
    $id = $_GET['id'];
    // check img
    $sql = mysqli_query($con, "SELECT `img` FROM `news` WHERE `id`='$id'");
    $row = mysqli_fetch_assoc($sql);
    if ($row['img'] != '') {
        unlink('../../photos/news/thumbs/'.$row['img'].'');
        unlink('../../photos/news/large/'.$row['img'].'');
    }
    // delete
    $delete = mysqli_query($con, "DELETE FROM `news` WHERE `id`='$id'");
    // result
    if ($delete) {
        header('location: ../index.php?page=news&result=1');
    } else {
        header('location: ../index.php?page=news&result=0');
    }
    exit;
}
// exit
if ($_GET['cmd'] == 'exit') {
    session_destroy();
    header('location: ../admin.php');
    exit;
}
?>