<form action="search.php" method="get">
    <input type="search" name="search">
    <button type="submit">Որոնում</button>
</form>

<?php
// DB connection
require_once('inc/connect.php');
// search
if (isset($_GET['search'])) {
    $s = trim(htmlspecialchars($_GET['search']));
    $s_query = "WHERE `title` LIKE '%$s%'";
} else {
    $s_query = '';
}
// get news
$sql_news = mysqli_query($con, "SELECT * FROM `news` $s_query");
while($row_news = mysqli_fetch_assoc($sql_news)) {
    $title = $row_news['title'];
    ?>
    <div class="item"><?=$title?></div>
<?php }?>