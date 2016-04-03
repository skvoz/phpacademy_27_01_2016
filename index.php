<?php
session_start();

require_once __DIR__ . '/db-conf.php';
require_once __DIR__ . '/libs.php';

if (isAuthorized() !== true) {
    header('LOCATION: ./registration.php');
}

$db = New Db;
$update = $db->updateProducts($db->link);
//echo $update;
$items = $db->getItems($db->link);
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
        <div class="add-item <?=$userCanAdd; ?>">
            <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" >
                <div>Add new item</div>
                <div><input type="text" name="name" value=""></div>
                <div>
                            <textarea type="text" name="description" cols="40" rows="2" ></textarea>
                </div>
                <div><input type="text" name="price" value="" ></div>
                <div><input type="text" name="image"  value="" ></div>
                <div <?=classAdd($userCanAdd); ?>><input type="text" name="is_active" value="" ></div>
                <div><input type="text" name="vendor"  value="" ></div>
                <div></div>
                <div><input type="submit" value="save" name="action" ></div>
            </form>
        </div>
        <div>
            <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th>
            <th <?=classAdd($userCanAdd); ?>>IS Active</th><th>vendor</th><th>Edit Date</th><th>saving</th>
        </div>
<!--    ** CHOOSE FILTER-->
        <div>
            <form method="GET" action="<?= $_SERVER['PHP_SELF']?>" >
                <div></div>
                <div></div>
                <div></div>
                <div colspan="2">
                    <label>Price range: </label>
                    <?=$db->getPriceRange(); ?><br>
                    <label>Price order: </label>
                    <select id="praice-order" name="price_order">
                        <option value="">not selected</option>
                        <option value="ASC">Asc</option>
                        <option value="DESC">Desc</option>
                    </select>
                </div>
                <div <?=classAdd($userCanAdd); ?>></div>
                <div><?=$db->getVendors(); ?></div>
                <div></div>
                <div><input type="submit" value="filter" name="filter" ></div>
            </form>
        </div>
<!--    ** GET ITEMS -->
    <?php foreach ($items as $item) : ?>
        <?php $editable = canEdit(); ?>
        <div class="edit-item">
            <form method="POST" action="<?= $_SERVER['PHP_SELF']?>" >
                <div class="one-row">
                    <p>ID: <input type="text" name="id" <?=$editable;?> value="<?= $item['id']?>" ></p>
                    <p>Item: <input type="text" name="name" <?=$editable;?> value="<?= $item['name']?>" ></p>
                    <p>Vendor: <input type="text" name="vendor" <?=$editable;?> value="<?= $item['vendor']?>" ></p>
                    <p>Price: <input type="text" name="price" <?=$editable;?> value="<?= $item['price']?>"></p>
                    <p>Is Active:
                        <select <?=$editable;?> name="is_active" >
                            <option <?=isSelected($item['is_active'], 1)?> value="1">Enabled</option>
                            <option <?=isSelected($item['is_active'], 0)?> value="0">Disabled</option>
                        </select>
                    </p>
                </div>
                <div class="one-row">
                    <p>Date: <input type="text" name="edit_date" <?=$editable;?> disabled value="<?= $item['edit_date']?>"></p>
                        <span>Describe:</span>
                        <textarea type="text" name="description" cols="35" rows="3"<?=$editable;?> ><?= $item['description']?></textarea>

                </div>
                <p>Image path: <input type="text" name="image" <?=$editable;?> value="<?= $item['image']?>" > </p>
                <div <?=classAdd($userCanAdd);?>>
                    <input type="submit" value="save" name="action" <?=$editable;?> >
                </div>
            </form>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>