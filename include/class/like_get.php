<?php

trait like_get
{
    public function get_like($post_id)
    {
        $sql = "SELECT COUNT(*) AS liked FROM liked WHERE id_post = {$post_id} AND like_type=1";
        $like = $this->db->query($sql);
        $like = $like[0]['liked'];
        return $like;
    }

    public function get_dislike($post_id)
    {
        $sql = "SELECT COUNT(*) AS disliked FROM liked WHERE id_post = {$post_id} AND like_type=2";
        $dislike = $this->db->query($sql);
        $dislike = $dislike[0]['disliked'];
        return $dislike;
    }
    public function get_post_date($post_id, $user_id){
        $date = "SELECT set_date FROM liked WHERE id_post='{$post_id}' AND id_user='{$user_id}'";
        return $this->db->query($date);

    }
    public function add_like($post_id, $user_id)
    {
        $get = "SELECT id,set_date FROM liked WHERE id_post='{$post_id}' AND id_user='{$user_id}'";
        $get = $this->db->query($get);
        if ($get) {
            if(!$this->upd_like($get[0]['id'],$get[0]['set_date'],1,$user_id)){
                    return "Лайк можно менять 1 раз в сутки";
            }
        }else{
            $sql = "INSERT INTO liked(id_post, id_user, like_type, set_date) VALUES ('{$post_id}',{$user_id},1,'{$this->get_timestamp()}')";
            $this->db->query($sql);
        }
    }

    public function add_dilike($post_id, $user_id)
    {
        $get = "SELECT id,set_date FROM liked WHERE id_post='{$post_id}' AND id_user='{$user_id}'";
        $get = $this->db->query($get);
        if ($get) {
            if(!$this->upd_like($get[0]['id'],$get[0]['set_date'],2,$user_id)){
                return "Лайк можно менять 1 раз в сутки";
            }
        }else{
            $sql = "INSERT INTO liked(id_post, id_user, like_type, set_date) VALUES ('{$post_id}',{$user_id},2,'{$this->get_timestamp()}')";
            $this->db->query($sql);
        }
    }

    public function upd_like($id,$date,$type,$user_id){
        if($this->diif_time($date)>=1){
            $sql = "UPDATE liked AS l SET l.like_type={$type},l.set_date='{$this->get_timestamp()}' WHERE id = {$id}";
            $this->db->query($sql);
            return true;
        }else{
            return false;
        }
    }

    public function diif_time($add_like){
        $diff = $this->get_timestamp() - $add_like;
        $min = (int)(floor($diff / 60));
        return $min;
    }


}