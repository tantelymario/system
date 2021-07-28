<?php
$with_dir = $_GET["dir"];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator("tmp"), 
RecursiveIteratorIterator::SELF_FIRST);

$list_dir = array();
foreach($iterator as $file) {
if($file->isDir()) {
    $fichier = $file;
    $fichier = str_replace("\\","/",$fichier);
    $fichier = str_replace("tmp","",$fichier);
    $fichier = str_replace(".","",$fichier);
    $fichier = trim($fichier,"/");

    if(!in_array($fichier,$list_dir)){
        $list_dir[] = $fichier;
    }
}
}
$o = fopen("outputs/list_file.csv","w");

foreach($list_dir as $file){
    fwrite($o,$file."\n");
}
fclose($o);
echo "Output genereted at :outputs/list_file.csv";
shell_exec("Notepad++ outputs/list_file.csv");
