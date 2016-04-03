<?php

function filter($data, $type = 's') {
    switch ($type) {
        case 's' : $data = strip_tags(trim($data));
            break;
        case 'i': $data = (int) $data;
        case 'f': $data = (float) $data;
    }
}

function isAuthorized() {
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'ok') {
        return true;
    }
    return false;
}


function canEdit()
{
    if ( isset($_SESSION['role']) && ($_SESSION['role'] == 'admin') ) {
        return '';
    }
    return 'disabled';
}

function canAdd()
{
    if ( isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') ) {
        return '';
    }
    return 'is--hidden';
}

function getName()
{
    return $_SESSION['user'];
}

function classAdd($className)
{
    if ($className != null) {
        return ' class="' . $className . '"';
    }
    return '';
}



function getPriceOrder()
{
    if (isset($_GET['price_order']) && isset($_GET['price_order'])) {
        $price_order = strip_tags($_GET['price_order']);
        return $price_order;
    }
    return null;
}
function filterVendors()
{
    if (isset($_GET['filter']) && isset($_GET['vendor'])) {
        $vendor = strip_tags($_GET['vendor']);
        return $vendor;
    }
}

function filterPrice()
{
    if (isset($_GET['filter']) && isset($_GET['price_range']) && $_GET['price_range'] != '') {
        $prices = explode('-', $_GET['price_range']);
        $prices[0] = round($prices[0]);
        if ($prices[1] == 'more') {
            $prices[1] = 0;
        }
        return $prices;
    }
}