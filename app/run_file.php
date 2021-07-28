<div style="padding:15px;background-color:#333;color:#fff">
<?php
$token = md5(date("Ymd"));

$f = fopen("app/eval.php","r");
$c = "";
while($data = fgets($f))
{
    $c .= $data." "; 
}
fclose($f);
$c = str_replace("<?php","",$c);
$tab_key = array("="=>"x45","("=>"w1",")"=>"z1","$"=>"x46","function"=>"x53"," "=>"x20","echo"=>"x15","mysql"=>"b13","MYSQL"=>"b14","sql"=>"a23","select"=>"e04","a"=>"s23","u"=>"s24","SELECT"=>"e03","FROM"=>"e17","from"=>"e18","hellopro"=>"h12","HELLOPRO"=>"h13","Hellopro"=>"h14");
foreach($tab_key as $key => $val)
{
    $c = str_replace($key,$val,$c);
}
$tab_data = array("c"=>$c,"a"=>$token);
$data = json_encode($tab_data);
$data = urlencode($data);
echo file_get_contents('http://bo.hellopro.fr.edg-preprod-bo-pub.edg.lbn.fr/admin/repertoire_test/moulinettes_mario/script_divers/script/script_test.php?a='.$token.'&d='.$data); 
echo '<input type="hidden" value="x55">'; ?>
</div>