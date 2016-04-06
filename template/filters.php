<form method="get" action="" >
    <h4>Сортировка</h4>
    <select class='form-control' name="order_value">
        <option
            value="price" <?= (isset($_GET['order_type']) AND $_GET['order_value'] == 'price') ? 'selected' : ''; ?> >
            Цена
        </option>
        <option value="name" <?= (isset($_GET['order_type']) AND $_GET['order_value'] == 'name') ? 'selected' : ''; ?>>
            Название
        </option>
        <option
            value="vendor" <?= (isset($_GET['order_type']) AND $_GET['order_value'] == 'vendor') ? 'selected' : ''; ?>>
            Производитель
        </option>
        <option
            value="add_date" <?= (isset($_GET['order_type']) AND $_GET['order_value'] == 'add_date') ? 'selected' : ''; ?>>
            Дата добавления
        </option>
    </select>
    <select class='form-control' name="order_type">
        <option value="ASC" <?= (isset($_GET['order_type']) AND $_GET['order_type'] == 'ASC') ? 'selected' : ''; ?>>По
            возрастанию
        </option>
        <option value="DESC" <?php if (isset($_GET['order_type']) AND $_GET['order_type'] == 'DESC') {
            echo 'selected';
        } elseif (!isset($_GET['order_type'])) {
            echo 'selected';
        } ?>>По убыванию
        </option>
    </select>
    <h4>Цена</h4>
    <input class='form-control' type='number' name='price_fr' value='<?= $price_fr; ?>'>
    <input class='form-control' type='number' name='price_to' value='<?=$price_to?>' max='<?= $price_to ?>'>
    <h4>Производитель</h4>
    <?php
    foreach ($vendor as $v) {
        $name = $v['vendor'];
        $chec = '';
        if (isset($_GET['checVendor']) AND in_array($name, $_GET['checVendor'])) {
            $chec = "checked";
        }
        echo "<div class='filter_row'><input type=checkbox name='checVendor[]' id='{$name}' value='{$name}' $chec
/>" . "<label for='{$name}'>".$v['vendor']."</label></div>";
    }
    ?>
    <input class='btn-success btn' type='submit' name="filter" value='фильтровать'>
    <input class='btn-danger btn' type='submit' name='clear_form' value='сбросить'>
</form>
