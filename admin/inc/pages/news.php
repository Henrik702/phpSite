<h1><?=$title?></h1>

<form action="inc/conf.php?cmd=edit_page&page=news" method="post" name="edit_page">
    <p><input type="text" name="meta_d" placeholder="Meta description *" value="<?=$meta_d?>"></p>
    <p><textarea name="descr" placeholder="Բնութագիր *"><?=$descr?></textarea></p>
    <p><button type="submit">Պահպանել</button></p>
</form>

<div class="news">
<?php
// count rows
$sql_count = mysqli_query($con, "SELECT * FROM `news`");
$rows = mysqli_num_rows($sql_count);
// count items
$page_rows = 3;
// last page
$last = ceil($rows/$page_rows);
if($last < 1) { $last = 1; }
// page number
$pn = 1;
// get page number
if(isset($_GET['pn'])) { $pn = $_GET['pn']; }
// page number settings
if ($pn < 1) { $pn = 1; } else if ($pn > $last) { $pn = $last; }
// pagination controls
$pagination_ctrls = '';
// if more than 1 page
if($last != 1) {
	// if not 1-st page
	if ($pn > 1) {
        // previous page
        $previous = $pn - 1;
		$pagination_ctrls .= '<a href="?page=news&pn='.$previous.'" class="pn">Նախորդ</a>';
		// left from current page
		for($i = $pn - 2; $i < $pn; $i++) {
			if($i > 0){
		        $pagination_ctrls .= '<a href="?page=news&pn='.$i.'" class="pn">'.$i.'</a>';
			}
	    }
    }
	// current page
	$pagination_ctrls .= '<a class="pn active">'.$pn.'</a>';
	// right from current page
	for($i = $pn + 1; $i <= $last; $i++){
		$pagination_ctrls .= '<a href="?page=news&pn='.$i.'" class="pn">'.$i.'</a>';
		if($i >= $pn + 2){
			break;
		}
	}
	// next page
    if ($pn != $last) {
        $next = $pn + 1;
        $pagination_ctrls .= '<a href="?page=news&pn='.$next.'" class="pn">Հաջորդ</a>';
    }
}
// start & end
$limit = 'LIMIT ' .($pn - 1) * $page_rows .',' .$page_rows;
// get news
$sql_news = mysqli_query($con, "SELECT * FROM `news` ORDER BY `id` DESC $limit");
while($row_news = mysqli_fetch_assoc($sql_news)) {
    $id = $row_news['id'];
    $title = $row_news['title'];
    $descr = mb_substr($row_news['descr'], 0, 140).'...';
    // img
    if ($row_news['img'] == '') {
        $img = 'no_photo.jpg';
    } else {
        $img = $row_news['img'];
    }
    // date
    $date_time = date('H:i d.m.Y', strtotime($row_news['date']));
    ?>
    <div class="item">
        <a href="?page=item&id=<?=$id?>"><div class="photo" style="background-image: url(../photos/news/thumbs/<?=$img?>);"></div></a>
        <div class="info">
            <div class="heading"><a href="?page=item&id=<?=$id?>"><?=$title?></a></div>
            <div class="date"><?=$date_time?></div>
            <div class="descr"><p><?=$descr?></p></div>
        </div>
    </div>
<?php }?>

<div class="pagination"><?=$pagination_ctrls?></div>

</div>