<div class="text-block">
    <?= $post['post'] ?>
    <hr>
    <?= $post['post_date'] ?>
    <hr>
    <div class="col-md-6">
        
        Liked: <?= $post['like'] ?>
        Dislike: <?= $post['dislike'] ?>
        <?php
        ?>
    </div>
    <form action="" method="post" class="col-md-6">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <input type="submit" name="like" value="+">
        <input type="submit" name="dislike" value="-">
    </form>
</div>
