<?php
require_once($_SERVER['DOCUMENT_ROOT']."admin/secure/connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."admin/functions/functions.php");
require_once($_SERVER['DOCUMENT_ROOT']."script/maj_produit_societe/functions/functions_maj_produit_societe.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."fonctions/fonctions_generales.php");

echo $url_fiche_produit_francais = hellopro_traitement_donnee_annuaire_bo(hellopro_traitement_donnee_annuaire_bo(ajout_tracking_url(trim("https://www.google.com"))));