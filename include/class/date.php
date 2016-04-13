<?php
trait date{
    public function get_date(){
        return date('Y-m-d', time());
    }
    
    public function get_timestamp(){
        return time();
    }
}