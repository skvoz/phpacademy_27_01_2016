<?php
class Items
{
    private $image;
    public $selected;

    public function getItems()
    {
        $sql = 'SELECT * FROM products';
        if (isset($_SESSION['role']) && ($_SESSION['role'] != 'admin')) {
            $role = 'is_active=1';
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
            if (isset($whereIN) > 0 && $whereIN[0] != '') {
                $where[] = 'vendor IN (' . implode(', ', $whereIN) . ')';
            }
            $sql .= (sizeof($where) > 0) ? implode(' AND ', $where) : '';
        }
        if ($price_order = getPriceOrder()) {
            $sql .= " ORDER BY price $price_order";
        }

        $res = Db::query($sql);
        $items = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
        $this->selected = $items;
        return $this->selected;
    }

    public function updateItems()
    {
        if (isset($_POST['action']) && $_SESSION['role'] != 'guest') {
            $name = Db::escape_string($_POST['name']);
            $desc = Db::escape_string($_POST['description']);
            $price = Db::escape_string($_POST['price']);
            $is_active = Db::escape_string($_POST['is_active']);
            $vendor = Db::escape_string($_POST['vendor']);
//            $edit_date = Db::escape_string($_POST['edit_date']);
            $edit_date = date('Y-m-d H:i:s');
            $id = (isset($_POST['id'])) ? Db::escape_string($_POST['id']) : null;

            if ($is_active != null && $name != null && $price >= 0) {
                $data = "`name`='$name',
                        description='$desc',
                        price='$price',";
                $data .= (isset($this->image)) ? " image='$this->image'," : '';
                $data .= " is_active='$is_active',
                        vendor='$vendor',
                        edit_date='$edit_date'";
                if ($this->checkId($id) && $_SESSION['role'] == 'admin') {
                    $sql = "UPDATE products SET " . $data . " WHERE id=$id";
                } elseif ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') {
                    $id = (isset($id)) ? "id=$id, " : '';
                    $sql = "INSERT INTO products SET $id" . $data;
                }
//                var_dump($sql);
                return Db::queryExec($sql);
            }
        }
        return false;
    }

    public function saveImg()
    {
        if (isset($_FILES["image"]["error"]) && $_FILES["image"]["error"] == 0) {
            $targetPath = './assets/item-images';

            if (!is_dir($targetPath)) {
                mkdir($targetPath);
            }

            $imageFileType = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $targetFile = $targetPath . '/' . rand(10, 99) . date('siHdmy.') . $imageFileType;
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
            $res = Db::query($sql);
            return (bool)mysqli_fetch_row($res);
        }
        return false;
    }
}