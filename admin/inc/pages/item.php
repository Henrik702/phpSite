<form action="inc/conf.php?cmd=edit_news&id=<?=$id?>" method="post" name="edit_news" enctype="multipart/form-data">
    <p><input type="text" name="title" placeholder="Վերնագիր *" value="<?=$title?>"></p>
    <img src="../photos/news/large/<?=$img?>" class="photo">
    <p><input type="file" name="img"></p>
    <p><textarea name="descr" placeholder="Բնութագիր *"><?=$descr?></textarea></p>
    <p class="action">
        <button type="submit">Պահպանել</button>
        <a href="inc/conf.php?cmd=delete_news&id=<?=$id?>" class="delete">Հեռացնել</a>
    </p>
</form>