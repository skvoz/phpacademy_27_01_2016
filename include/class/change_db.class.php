<?php
class change_db{
    private $date;
    public function __construct(db $db){
        $this->db = $db;
        $this->date = date('Y-m-d', time());
    }

    public function insetr($name,$desc,$price,$active,$vendor){
        $sql = "INSERT INTO products SET
        `name`='{$name}',
        description='{$desc}',
        price='{$price}',
        image='{$this->upload_image()}',
        is_active='{$active}',
        vendor='{$vendor}',
        add_date = '{$this->date}'";
        $this->db->query($sql);
    }

    public function update($id,$name,$desc,$price,$active,$vendor){
        echo $id,$name,$desc,$price,$active,$vendor;

        $sql = "UPDATE products SET
        `name`='{$name}',
        description='{$desc}',
        price='{$price}',
        image='{$this->upload_image()}',
        is_active='{$active}',
        vendor='{$vendor}',
        upd_date = '{$this->date}'
        WHERE id='{$id}'";
        $this->db->query($sql);
    }

    public function upload_image(){
        if(isset($_FILES['image']['tmp_name']) AND getimagesize($_FILES['image']['tmp_name'])) {
            $info = new SplFileInfo($_FILES['image']['name']);
            $img_name = count(scandir('uploads')) . '_' . uniqid() . '.' . $info->getExtension();
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads' . DIRECTORY_SEPARATOR . $img_name);
        } else {
            $img_name = $_POST['imageOld'];
        }
        return $img_name;
    }
}