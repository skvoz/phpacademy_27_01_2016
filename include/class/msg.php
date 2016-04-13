<?php
class msg{
    use date,filter,refresh,like_get;
    public function __construct(db $db)
    {
        $this->db = $db;
    }
    public function add_msg($text,$user_id){
        $text = $this->valid($text);
        $date = $this->get_date();
        $sql = "INSERT INTO post(post, post_date, user_id) VALUES ('{$text}','{$date}',{$user_id})";
        $this->db->query($sql);
        $this->refresh();
    }
    
    public function get_msg(){
        $sql = "SELECT * FROM post ORDER BY id DESC";
        $msg = $this->db->query($sql);
        return $msg;
    }
    
    public function display_msg(){
        $msg = $this->get_msg();
        foreach ($msg as $post){
            $post['like'] = $this->get_like($post['id']);
            $post['dislike'] = $this->get_dislike($post['id']);
            $add_like = $this->get_post_date($post['id'],$_SESSION['user_id']);
            include './template/mst_tmp.php';
        }
    }
}