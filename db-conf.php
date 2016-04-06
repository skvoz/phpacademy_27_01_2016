<?php

class Db
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'php_class01';

    public $link;
    private $image;

    public function __construct()
    {
         return $this->connect();
    }

    public function connect()
    {
        $this->link = mysqli_connect(Db::DB_HOST, Db::DB_USER, Db::DB_PASS, Db::DB_NAME);
    }

    public function createUser($login, $pass)
    {
        $sql = "INSERT INTO users SET user='$login', pass='$pass'";
        mysqli_query($this->link, $sql);
        return mysqli_insert_id($this->link);
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT user, role FROM users WHERE id='$user_id'";
        $res = mysqli_query($this->link, $sql);
        return mysqli_fetch_assoc($res);
    }

    public function getItems()
    {
        $sql = 'SELECT * FROM products';
        if (isset($_SESSION['role']) && ($_SESSION['role'] != 'admin') ) {
            $role= 'is_active=1';
            $where[] = $role;
        } else {
            $role = '';
        }
        if ($vendors = filterVendors()) {
            foreach ($vendors as $vendor) {
                if ($vendor != '') {
                    $whereIN[] = "'$vendor'";
                }
            }
        } else {
            $vendor = '';
        }
        if ($prices = filterPrice()) {
            if ($prices[0] < $prices[1]) {
                $price = " price BETWEEN ${prices[0]} AND ${prices[1]}";
                $where[] = $price;
            } elseif ($prices[0] > $prices[1]) {
                $price = " price > ${prices[0]}";
                $where[] = $price;
            } else {
                $price = '';
            }
        }

        if (isset($where) or isset($whereIN)) {
            $sql .= " WHERE ";
            if (isset($whereIN)  > 0 && $whereIN[0] != '') {
                $where[] = 'vendor IN ('.implode(', ', $whereIN).')';
            }
            $sql .= (sizeof($where) > 0 ) ? implode(' AND ', $where) : '';
        }
        if ($price_order = getPriceOrder()) {
            $sql .= " ORDER BY price $price_order";
        }

//        var_dump($sql);  // SHOW SQL QUERY
        $res = mysqli_query($this->link, $sql);
        $items = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
        return $items;
    }

    public function updateProducts()
    {
        if (isset($_POST['action']) && $_SESSION['role'] != 'guest') {
            $name = mysqli_real_escape_string($this->link, $_POST['name']);
            $desc = mysqli_real_escape_string($this->link, $_POST['description']);
            $price = mysqli_real_escape_string($this->link, $_POST['price']);
            $is_active = mysqli_real_escape_string($this->link, $_POST['is_active']);
            $vendor = mysqli_real_escape_string($this->link, $_POST['vendor']);
            $edit_date = date('Y-m-d H:i:s');
            $id = (isset($_POST['id'])) ? mysqli_real_escape_string($this->link, $_POST['id']) : null;

            if ( $is_active != null && $name != null) {
                $data = "`name`='$name',
                description='$desc',
                price='$price',
                image='$this->image',
                is_active='$is_active',
                vendor='$vendor',
                edit_date='$edit_date'";
                if ($this->checkId($id) && $_SESSION['role'] == 'admin') {
                    $sql = "UPDATE products SET ".$data." WHERE id=$id";
                } elseif ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') {
                    $id = (isset($id)) ? "id=$id, " : '';
                    $sql = "INSERT INTO products SET $id".$data;
                }
                mysqli_query($this->link, $sql);
            }
        }
    }

    public function saveImg()
    {
        if (isset($_FILES["image"]["error"]) && $_FILES["image"]["error"] == 0) {
            $targetPath = './assets/item-images';

            if (!is_dir($targetPath)) {
                mkdir($targetPath);
            }

            $imageFileType = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $targetFile = $targetPath . '/' . rand(10,99).date('siHdmy.') . $imageFileType;
            $filePath = $_FILES["image"]["tmp_name"];
            $type = strpos('jpg|jpeg|bmp|gif|png', strtolower($imageFileType));
            // Check if image file is a actual image or fake image
            if ($type !== false && !empty($filePath)) {
                $check = getimagesize($filePath);
            } else {
                return "Load a file please...";
            }
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                if (move_uploaded_file($filePath, $targetFile)) {
                    $this->image = $targetFile;
                    //'uploaded seccesfully;

                }
            }
        }

    }

    public function checkId($id)
    {
        if (isset($id)) {
            $sql = "SELECT id FROM products WHERE id='$id'";
            $res = mysqli_query($this->link, $sql);
            return (bool)mysqli_fetch_row($res);
        }
        return false;
    }

    function getPriceRange()
    {
        $sql = 'SELECT MIN(price) as min, MAX(price) as max FROM products';
        $res = mysqli_query($this->link, $sql);
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
        $res = mysqli_query($this->link, $sql);
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

    function login($user_id) {
        $_SESSION['auth'] = 'ok';
        $_SESSION['user_id'] = $user_id;

        $user_info = $this->getUserById($user_id);
        $_SESSION['user'] = $user_info['user'];
        $_SESSION['role'] = $user_info['role'];

        header('LOCATION: ./index.php');
    }
}