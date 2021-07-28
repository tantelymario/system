<?php
/**
 * Author : Tantely Mario
 * Description : Basse class for controller
 */
abstract class Controller{
    
    //File use for the view
    protected static $page_name = "";

    //Method to set page name
    protected function set_page($page){
        self::$page_name = $page;
    }

    //Method use to render a php file
    public function render(){
        require_once($_SERVER['DOCUMENT_ROOT']."//views/".self::$page_name."/".self::$page_name.".php");
    }

    //Method to get parms $_GET parameters
    public function get_params($param_name){
        if(empty($param_name)){
            $f = fopen($_SERVER['DOCUMENT_ROOT']."/logs/error.log","a");
            fwrite($f,'> Error when trying to access $_GET["'.$param_name.'"] from : '.self::$page_name.'\n');
            fclose($f);
            return 0;
        }
        else{
            return $_GET[$param_name];
        }
    }

    //Method to get parms $_POST parameters
    public function post_params($param_name){
        if(empty($param_name)){
            $f = fopen($_SERVER['DOCUMENT_ROOT']."logs/error.log","a");
            fwrite($f,'> Error when trying to access $_POST["'.$param_name.'"] from : '.self::$page_name.'\n');
            fclose($f);
            return 0;
        }
        else{
            return $_POST[$param_name];
        }
    }

}