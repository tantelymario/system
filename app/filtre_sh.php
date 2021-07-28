<?php
$tab_list_file = scan_dir_file("files");
$o = fopen("outputs/script_sh.log","w");
foreach($tab_list_file as $file){
    if(preg_match('#\.sh#',$file,$match)){
        $f = fopen("files/".$file,"r");
        while($data = fgets($f)){
            if(!preg_match('#^\##',$data,$match_) && !empty($data)){
                $data = trim(str_replace("&","",$data));
                if($data != "\n"){
                    $data = str_replace("/home/sites_web/edgb2b/","",$data);
                    fwrite($o,$data."\n");
                }
            }
        }
        fclose($f);
    }
}
fclose($o);
echo "Output genereted at : outputs/script_sh.log";
shell_exec("Notepad++ outputs/script_sh.log");
fclose($o);
