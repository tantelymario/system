<?php
$tab_list_file = scan_dir_file("tmp");
if(empty($tab_list_file)){
    echo "No file found inside tmp directory";
}
$o = fopen("outputs/mep.csv","w");
$date = $_GET["date"];
fputcsv($o,array("Date","File"),';');
foreach($tab_list_file as $file){
    if(preg_match('#\.php#',$file,$match)){
        fputcsv($o,array($date,$file),';');
    }
}
fclose($o);
echo "Output genereted at :outputs/mep.csv";
shell_exec("Notepad++ outputs/mep.csv");
fclose($o);
