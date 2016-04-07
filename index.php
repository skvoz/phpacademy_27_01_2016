<?php
require_once __DIR__ . '/autoload.php';

if (Auth::isAuthorized() !== true) {
    header('LOCATION: ./registration.php');
}

Db::connect();
$users = New Users();
$items = New Items();
$items->saveImg();
$items->updateItems();
$items->getItems();
$filter = New ItemsFilter();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products table</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <nav id="nav">
        <ul>
            <li><a href="logout.php"> Logout(<?=getName(); ?>)</a></li>
        </ul>

    </nav>
    <div id="table-products">
    <?php $userCanAdd = canAdd(); ?>
<!--    ** ADD ITEM-->
        <div class="edit-item add-item <?=$userCanAdd; ?>">
            <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <div class="one-row-1">
                    <h2>Add new item:</h2>
                </div>
                <div class="one-row">
                    <p>Item: <input type="text" name="name" value=""></p>
                    <p>Vendor: <input type="text" name="vendor" value="" ></p>
                    <p>Price: <input type="text" name="price" value=""></p>
                </div>
                <div class="one-row">
                    <span>Describe:</span>
                    <textarea type="text" name="description" cols="27" rows="3" ></textarea>
                </div>
                <div class="last-row">
                    <p>Upload image:<br> <input type="file" name="image"></p>
                    <p>Is Active:
                        <select <?=classAdd($userCanAdd); ?> name="is_active" >
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                        <input <?=classAdd($userCanAdd);?> type="submit" value="save changes" name="action">
                    </p>
                    <p>

                    </p>
                </div>
            </form>
        </div>
<!--    ** CHOOSE FILTER-->
        <div class="add-item items-filter">
            <form method="GET" action="<?= $_SERVER['PHP_SELF']?>" >
                <div><h3>Filter:</h3>
                    <label>Price range: </label>
                    <?=$filter->getPriceRange(); ?><br>
                    <label>Price order: </label>
                    <select id="praice-order" name="price_order">
                        <option value="">not selected</option>
                        <option value="ASC">Asc</option>
                        <option value="DESC">Desc</option>
                    </select>
                </div>
                <div <?=classAdd($userCanAdd); ?>></div>
                <div>Vendors: <?=$filter->getVendors(); ?></div>
                <div></div>
                <div><input type="submit" value="filter" name="filter" ></div>
            </form>
        </div>
<!--    ** GET ITEMS -->
    <?php foreach ($items->selected as $item) : ?>
        <?php $editable = canEdit(); ?>
        <div class="edit-item">
            <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <div class="one-row-1">
                    <p>ID: <input type="text" name="id" <?=$editable;?> value="<?= $item['id']?>" ></p>
                    <p>Item: <input type="text" name="name" <?=$editable;?> value="<?= $item['name']?>" ></p>
                    <p>Vendor: <input type="text" name="vendor" <?=$editable;?> value="<?= $item['vendor']?>" ></p>
                    <p>Price: <input type="text" name="price" <?=$editable;?> value="<?= $item['price']?>$"> </p>
                </div>
                <div class="one-row">
                    <span>Describe:</span>
                    <textarea type="text" name="description" cols="27" rows="3"<?=$editable;?> ><?= $item['description']?></textarea>
                    <p>Is Active:
                        <select <?=$editable;?> name="is_active" >
                            <option <?=isSelected($item['is_active'], 1)?> value="1">Enabled</option>
                            <option <?=isSelected($item['is_active'], 0)?> value="0">Disabled</option>
                        </select>
                    </p>
                </div>
                <div class="item-img">
                    <img src="<?= isset($item['image']) ? $item['image'] : './item-images/no-item-image.jpg'; ?>" alt="товар">
                </div>
                <div class="last-row">
                    <p>Image path: <br><span><?= $item['image']?></span></p>
                    <p>change image: <input type="file" name="image"></p>
                    <p>
                        Date: <input class="table-date" type="text" name="edit_date" disabled value="<?= $item['edit_date']?>">
                        <input <?=classAdd($userCanAdd);?> type="submit" value="save changes" name="action" <?=$editable;?> >
                    </p>
                </div>
            </form>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>