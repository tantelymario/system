<?php
class CLI{
    
    private static $command = "";
    private static $tab_command_list = array();
    private static $command_name = "";
    private static $tab_parameters = array();

    function __construct($cmd){
        $cmd = preg_replace('#\s+#',' ',$cmd);
        self::$command = $cmd;
        
        /** Get the command name */
        $tab_cmd = explode(" ",$cmd);
        self::$command_name= trim($tab_cmd[0]);
        
        /** Get parameters */
        preg_match_all('#\-\-([a-z])*(\s+|)([a-zA-Z0-9\_\-\/\.])*#',$cmd,$match_parametre);
        self::$tab_parameters = $match_parametre;

        self::load_custom_command();
    }

    //Load custom command
    private function load_custom_command(){
        $f = file_get_contents($_SERVER['DOCUMENT_ROOT']."/app/app.json");
        self::$tab_command_list = json_decode($f,true);
    }

    //Execute command
    public function exec_command(){
        /** If it's a custom command */
        if(!empty(self::$tab_command_list["app"][self::$command_name]))#PHP script
        {
            if(self::$tab_command_list["app"][self::$command_name]["type"] == "php"){
                foreach(self::$tab_parameters[0] as $parameter)
                {
                    $tab_parametre = explode(" ",$parameter);
                    $a = str_replace("--","",$tab_parametre[0]);
                    if($a == "help")
                    {
                        echo self::$tab_command_list["app"][self::$command_name]["desc"];
                        exit;
                    }
                    $_GET[$a] = $tab_parametre[1];
                }
                require_once($_SERVER['DOCUMENT_ROOT']."//app/".self::$tab_command_list["app"][self::$command_name]["file"]);
            }else if(self::$tab_command_list["app"][self::$command_name]["type"] == "text"){
                echo self::$tab_command_list["app"][self::$command_name]["value"];
            }
        }else if(!empty(self::$tab_command_list[self::$command_name])){
            switch(self::$tab_command_list[self::$command_name]["type"])
            {
                case "message":
                    echo self::$tab_command_list[self::$command_name]["value"];
                break;
                case "system":
                    switch(self::$command_name)
                    {
                        case "install":
                            $source_file = "";
                            $app_name = "";
                            $app_desc = "";
                            foreach(self::$tab_parametres[0] as $parameter)
                            {
                                $tab_parametre = explode(" ",$parameter);
                                $a = str_replace("--","",$tab_parametre[0]);
                                if($a == "help")
                                {
                                    echo self::$tab_command_list["install"]["desc"];
                                    exit;
                                }
                                if($a == "file")
                                {
                                    $source_file = str_replace(".php","",$tab_parametre[1]);
                                }
                                if($a == "name")
                                {
                                    $app_name = trim($tab_parametre[1]);
                                }
                                if($a == "desc")
                                {
                                    $app_desc = trim($tab_parametre[1]);
                                }
                            }
                            if(empty($source_file) || empty($app_name))
                            {
                                echo self::$tab_command_list["install"]["desc"];
                                exit;
                            }
                            else
                            {
                                if(!rename("tmp/".$source_file.".php","app/".$app_name.".php"))
                                {
                                    echo "Installation error";
                                    exit;
                                }
                                self::$tab_command_list["app"][$app_name]["type"] = "php";
                                self::$tab_command_list["app"][$app_name]["file"] = $app_name.".php";
                                self::$tab_command_list["app"][$app_name]["desc"] = (!empty($app_desc))?$app_desc:"Aucune description";
                            }
                            $f = fopen("app/app.json","w");
                            fwrite($f,json_encode(self::$tab_command_list));
                            fclose($f);
                        break;
                        case "remove":
                            foreach(self::$tab_parametre[0] as $parameter)
                            {
                                $tab_parametre = explode(" ",$parameter);
                                $source_file = "";
                                $app_name = "";
                                $app_desc = "";
                                $a = str_replace("--","",$tab_parametre[0]);
                                if($a == "help")
                                {
                                    echo self::$tab_command_list[self::$command_name]["desc"];
                                    exit;
                                }
                                if($a = "name")
                                {
                                    $app_name = trim($tab_parametre[1]);
                                }
                            }
                            unlink("app/".self::$tab_command_list["app"][$app_name]["file"]);
                            unset(self::$tab_command_list["app"][$app_name]);
                            $f = fopen("app/app.json","w");
                            fwrite($f,json_encode(self::$tab_command_list));
                            fclose($f);
                        break;
                    }
                break;
                default:
                    echo "Command not found";
            }
        }
        else{
            $result_exec = shell_exec(self::$command);
            if(preg_match('#phpcs#',$cmd,$matchcs)){
                $result_exec = str_replace("\n","<br>",$result_exec);
                $result_exec = preg_replace('/\<br\>(\s+|)\|(\s+|)\|/'," ||",$result_exec);
            }
            $result_exec = preg_replace('#error#i','<b style="color:red">Error</b>',$result_exec);
            echo $result_exec;
        }
    }
}