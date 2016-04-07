<?php
class ItemsFilter
{
    function getPriceRange()
    {
        $sql = 'SELECT MIN(price) as min, MAX(price) as max FROM products';
        $res = Db::query($sql);
        $vals = mysqli_fetch_assoc($res);
        $step = floor(($vals['max'] - $vals['min']) / 5);
        $out =  '<select name="price_range">'
            .   "<option value=\"\">All</option>";
        for ($i = 0 ; $i < 6; ) {
            $price[$i] = $vals['min'] + $step * $i;
            $price[++$i] = $vals['min'] + $step * $i;
            if ($price[$i] > $vals['max']) {
                $price[$i] = "more";
            }
            if (isset($_GET['price_range']) &&
                $_GET['price_range'] == "${price[$i-1]}-${price[$i]}") {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $out .= "<option $selected value=\"${price[$i-1]}-${price[$i]}\">${price[$i-1]} - ${price[$i]}</option>";
        }
        $out .= '</select>';
        return $out;
    }

    function getVendors()
    {
        $sql = 'SELECT vendor FROM products GROUP BY vendor';
        $res = Db::query($sql);
        $vendors = mysqli_fetch_all($res);

        $out = '<select name="vendors[]" multiple>'
            .     "<option value=\"\">All</option>";
        foreach ($vendors as $vendor) {

            if (isset($_GET['vendors']) &&
                $_GET['vendors'] == $vendor[0]) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $out .= "<option $selected value=\"${vendor[0]}\">${vendor[0]}</option>";
        }
        $out .= '</select>';
        return $out;
    }

}