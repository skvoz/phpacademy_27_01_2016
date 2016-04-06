<?php
function get_item(db $db)
{ // Получение данных для карточек
    $sql_price_filter = null;
    $sql_vendor_filter = null;
    if (isset($_GET['price_fr']) AND isset($_GET['price_to']) AND is_numeric($_GET['price_fr']) AND is_numeric($_GET['price_to'])) {
        $sql_price_filter = (isset($_GET['checVendor'])) ? 'AND' : 'WHERE';
        $sql_price_filter .= ' ' . "price >= {$_GET['price_fr']} AND price <= {$_GET['price_to']}";
    }
    if (isset($_GET['checVendor'])) {
        $fin = '';
        foreach ($_GET['checVendor'] as $k => $v) {
            if (isset($_GET['checVendor'][($k + 1)])) {
                $fin .= "'$v'" . ",";
            } else {
                $fin .= "'$v'";
            }
        }
        $sql_vendor_filter = "WHERE vendor IN ({$fin})";
    }
    if (isset($_GET['order_value']) AND isset($_GET['order_type'])) {
        $order_by = "ORDER BY " . $_GET['order_value'] . ' ' . $_GET['order_type'];
    } else {
        $order_by = 'ORDER BY id DESC';
    }
    $items = $db->query("SELECT * FROM products {$sql_vendor_filter} {$sql_price_filter} {$order_by}");
    return $items;
}

function display_form($items,$user_priv)
{ // Вывод формы добавления товара и редактирования  имеющихся
    foreach ($items as $item) {
        if ($user_priv == 'y') {
            include 'template/admin_product.php';
        } elseif ($item['is_active']) {
            include 'template/user_product.php';
        }
    }
}


function display_filter($user_priv,db $db)
{ // Вывод фильтров
    if ($user_priv == 'y') {
        $admin = "WHERE is_active = 1";
    } else {
        $admin = null;
    }
    $p_max = $db->query("SELECT MAX(price) AS max FROM products");// mysqli_fetch_assoc(mysqli_query($link, $sql_p_max));
    $vendor = $db->query("SELECT DISTINCT vendor FROM products {$admin}");
    echo '<form method="get" action="">';
    $price_fr = '0';
    $price_to = $p_max[0]['max'];
    if (isset($_GET['price_fr'])) {
        $price_fr = $_GET['price_fr'];
    }
    if (isset($_GET['price_to'])) {
        $price_to = $_GET['price_to'];
    }
    include 'template/filters.php';
}