<div class="col-lg-4">
    <form method="post" action="" enctype="multipart/form-data" style="border: 1px solid crimson; margin-bottom: 10px;padding: 10px;">
        <div class="thumbnail">
            <img src=<?="uploads/{$item['image']}"?>>
        </div>
        <input class="form-control" type="hidden" name="id" value="<?= $item['id'] ?>">
        <span>Название</span>
        <input class="form-control" type="text" name="name" value="<?= $item['name'] ?>">
        <span>Описание</span>
        <textarea class="form-control" name="description" cols="35" rows="7"><?= $item['description'] ?></textarea>
        <span>Цена</span>
        <input class="form-control" type="text" name="price" value="<?= $item['price'] ?>">
        <?php
        if ($item['image'] == "") {
            echo "<span>Изображение</span>";
            echo "<input class='form-control' type='file' name='image'>";
        } else {
            echo "<span>Изображение</span>";
            echo "<input class='form-control' type='file' name='image'>";
            echo "<input class='form-control' type='text' name='imageOld' value={$item['image']}>";
        }
        ?>
        <span>Отображать</span>
        <input class="form-control" type="text" name="is_active" value="<?= $item['is_active'] ?>">
        <span>Производитель</span>
        <input class="form-control" type="text" name="vendor" value="<?= $item['vendor'] ?>">
        <span>Add date : <?= $item['add_date'] ?></span><br>
        <span>Update date : <?= $item['upd_date'] ?></span><br>
        <input class="btn btn-danger" type="submit" name='edit' value="Edit">
    </form>
</div>
