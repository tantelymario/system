<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.php");
class MSystem extends Model{
    function __construct($page_name){
        self::set_page($page_name);
    }
}