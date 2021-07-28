<?php
/**
 * Author : Novah
 * Description : Script utiliser pour la creation backup
 * Version : 0.0.1
 * Date : 11-07-2021
 */
/**
* Lire le contenu du fichier contenant la liste des fichiers to backed up
*/
$file_dir = $_GET['files'];
if(empty($file_dir)){
	$file_dir = "files/dir_hierarchy_backup.txt";
}
$a_file_test_bkp = file($file_dir, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

/*
* Créer un tableau qui contiendra la liste de chaque repertoire à creer
*/
$t_backup_dir = [];

/*
* Boucler le tableau contenant la ligne afin de pouvoir traiter soigneusement chaque ligne
*/
foreach($a_file_test_bkp as $line) {	
	$a_dir_name = explode('/', $line);
	//Supprimer le dernier élément du tableau car il ne s'agit pas d'un repertoire mais un fichier
	array_pop($a_dir_name);
	//Rassembler les vrai nom du repertoire
	$s_dir = implode('/', $a_dir_name) . '/';			
    //Remplire le tableau	
	array_unshift($t_backup_dir, $s_dir);
}

//Supprimer le doublon
$t_backup_dir = array_unique($t_backup_dir);

//Ajouter le backup dans le premier élément du tableau
array_unshift($t_backup_dir, 'backup');

foreach($t_backup_dir as $new_dir){
	/*
	* Tester si la ligne contenant une caractère slash
	* car si c'est le cas, soit on doit créer la repertoire racine 
	* soit une repertoire single à l'interieur de la racine
	*/
	if(!preg_match('/\//', $new_dir)) {
		$s_dir = $new_dir;
		create_directory_hp_backup($s_dir);
		if('backup' == $s_dir){
			chdir('backup');
			echo ' On est dans le repertoire '.getcwd()."\n";
		}
	} else {
		/*
		* Donc ici le repertoire n'est pas single donc il y a des niveaux
		*/
		
		//Separer chaque niveaux
		$t_new_rep_hierarchy = explode('/', $new_dir);
		
		//Compter le nombre des niveaux à faire
		$i_nb_partition = count($t_new_rep_hierarchy);
		
		//Prendre le premier niveau pour creer d'abord le super niveau
		$s_dir = $t_new_rep_hierarchy[0];
		
		//Boucler la création en fonction du nombre des niveaux à créer
		for($i = 0; $i < $i_nb_partition; $i++) {			
		    /*
			* Tester si on est sur le debut de la boucle
			* c'est à dire qu'il faut créer le repertoire dans le plus haut niveau
			* donc créer la super niveau
			*/
			if(0 == $i) {
			    create_directory_hp_backup($s_dir);
			}
			
			/*
			* Tester si on est dans le niveau le plus bas que le super niveau
			* pour cela on concatène le nom du repertoire de la super niveau 
			* avec chaque nom du repertoire au plus bas niveau
			* et repeter cette action jusqu'au niveau le plus bas
			* creer les repertoire du plus bas niveau et on respect le tour pour chacun
			*/
			if((0 < $i) and ($i_nb_partition -1 != $i)) {
				$s_dir .= '/'.$t_new_rep_hierarchy[$i];
				create_directory_hp_backup($s_dir);
			}			
		}
	}
}
/**Deplace les repertoire creer dans le repertoire outputs */
rename("backup","outputs/backup");
/**
* Cette fonction crée les nouveaux repertoire du backup
*/
function create_directory_hp_backup ($dir_to_create){
	/*
	* Tester si le repertoire à créer existe déjà
	* si c'est le cas, quitter la fonction
	*/
	if(is_readable($dir_to_create) || 0 == strlen($dir_to_create)) {
		return;
	}
	if(mkdir($dir_to_create)) {
		echo 'Le repertoire '.$dir_to_create.' a été créer'."\n";
	}else{
		echo 'La création de la repertoire '.$dir_to_create.' est echoué'."\n";
	}	
}