<!--
<ul>
    <li>Ծրագրավորում</li>
    <ul>
        <li>JavaScript</li>
        <li>PHP</li>
    </ul>
    <li>Ինֆորմացիոն տեխնոլոգիաներ</li>
    <ul>
        <li>Ընկերություններ</li>
        <li>Ապագայի տեխնոլոգիաներ</li>
    </ul>
    <li>Բիզնես</li>
    <ul>
        <li>Էլեկտրոնային կոմերցիա</li>
        <li>Իննովացիաներ</li>
    </ul>
</ul>
-->

<?php
// DB connection
require_once('inc/connect.php');
// cats
echo '<ul>';
$sql_cats = mysqli_query($con, "SELECT * FROM `cats`");
while($row_cats = mysqli_fetch_assoc($sql_cats)) {
    $cat_id = $row_cats['id'];
    $cat_name = $row_cats['name'];
    echo '<li>'.$cat_name.'</li>';
    // subcats
    $sql_subcats = mysqli_query($con, "SELECT * FROM `subcats` WHERE `cat_id`='$cat_id'");
    if (mysqli_num_rows($sql_subcats) > 0) {
        echo '<ul>';
        while($row_subcats = mysqli_fetch_assoc($sql_subcats)) {
            $subcat_id = $row_subcats['id'];
            $subcat_name = $row_subcats['name'];
            echo '<li><a href="?subcat='.$subcat_id.'">'.$subcat_name.'</a></li>';
        }
        echo '</ul>';
    }
}
echo '</ul>';
?>

<?php
// check query
if (isset($_GET['subcat'])) {
    $my_query = "WHERE `subcat_id`='".$_GET['subcat']."'";
} else {
    $my_query = '';
}
// get news
$sql_news = mysqli_query($con, "SELECT * FROM `news` $my_query");
while($row_news = mysqli_fetch_assoc($sql_news)) {
    $title = $row_news['title'];
    ?>
    <div class="item"><?=$title?></div>
<?php }?>