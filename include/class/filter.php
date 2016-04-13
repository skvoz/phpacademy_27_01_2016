<?php
trait filter{
    public function valid($text){
        return strip_tags(trim($text));
    }
}