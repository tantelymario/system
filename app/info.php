<h3>=> Info sur les variables utilis&eacute; dans la migration</h3>
<textarea style="padding:12px;width:100%;height:400px" readonly>
<?php
$tab_info = array('$GLOBALS["protocol_http_host_bo"]',
'"LINK_MYSQLI_ANNUAIRE_BO"=>"hellopro_traitement_donnee_annuaire_bo"',
'"LINK_MYSQLI_ANNUAIRE_FRONT"=>"hellopro_traitement_donnee_annuaire_front"',
'"LINK_MYSQLI_LPP_BO"=>"hellopro_traitement_donnee_lpp_bo"',
'"LINK_MYSQLI_MATERIEL_FRONT"=>"hellopro_traitement_donnee_materiel_front"',
'"LINK_MYSQLI_DEVIS_FRONT"=>"hellopro_traitement_donnee_devis_front"',
'"LINK_MYSQLI_HELLODEVIS_FRONT"=>"hellopro_traitement_donnee_hellodevis_front"',
'"LINK_MYSQLI_HELLODEVIS_BO"=>"hellopro_traitement_donnee_hellodevis_bo"',
'"LINK_MYSQLI_HELLOPRO_DATA"=>"hellopro_traitement_donnee_hellopro_data"',
'"LINK_MYSQLI_LOGS_SEO"=>"hellopro_traitement_donnee_logs_seo"',
'"LINK_MYSQLI_DATA"=>"hellopro_traitement_donnee_data"',
'"LINK_MYSQLI_UBEPRO"=>"hellopro_traitement_donnee_ubepro"',
'"LINK_MYSQLI_KIOSK"=>"hellopro_traitement_donnee_kiosk"',
'"LINK_MYSQLI_MRBIZZNET"=>"hellopro_traitement_donnee_mrbizznet"',
'$ligne[1] = preg_replace("#\<br(\s+|)\/\>#","<br>",$ligne[1]);');

$i = 1;
foreach($tab_info as $value)
{
    echo $i." - ".$value."\n";
    $i++;
} ?>
</textarea>
<input type="hidden" value="x55">