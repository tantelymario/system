<?php
/**
 * Author : Tantely Mario
 * Description : Basse class for controller
 */
abstract class Model{

    //Name of page
    protected static $page_name;
    
    //Field uses to store data from ram
    protected $ram = array();

    //Method to set page name
    protected function set_page($page){
        self::$page_name = $page;
        self::load_ram();
    }

    //Method use to load data from ram
    protected function load_ram(){
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."//tmp/".self::$page_name.".json")){
            touch($_SERVER['DOCUMENT_ROOT']."//tmp/".self::$page_name.".json");
        }
        $d = file_get_contents($_SERVER['DOCUMENT_ROOT']."//tmp/".self::$page_name.".json");
        $this->ram = json_decode($d,true);
    }

    //Method to get data from ram
    public function get_data($name){
        return $this->ram[$name];
    }

    //Method to insert data to ram
    public function insert_data($name,$data){
        $this->ram[$name] = $data;
        $f = fopen($_SERVER['DOCUMENT_ROOT']."//tmp/".self::$page_name.".json","w");
        fwrite($f,json_encode($this->ram));
        fclose($f);
    }

    //Method to delete data from ram
    public function delete_data($name){
        unset($this->ram[$name]);
        $f = fopen($_SERVER['DOCUMENT_ROOT']."//tmp/".self::$page_name.".json","w");
        fwrite($f,json_encode($this->ram));
        fclose($f);
    }
}