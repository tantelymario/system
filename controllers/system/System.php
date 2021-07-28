<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/Controller.php");

class System extends Controller{
    function __construct($page_name){
        self::set_page($page_name);
    }
}