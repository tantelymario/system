<?php

?>
<div class="migration">
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active home" aria-current="page" href="#">Migration php 7 Domaine : <?php echo strtoupper($_GET['d']);?></a>
            </li>
            <button type="button" data-target="Filtrer" class="btn-command btn btn-info" <?php if($_GET['d'] == 'mep'){ echo " disabled ";}?>>Filtrer</button>
            <button type="button"  data-target="Run" class="btn-command btn btn-info">Run</button>
            <button type="button"  data-target="Reset" class="btn-reset btn btn-info">Reset</button>
            <button type="button"  data-target="Reset" class="btn-cli btn btn-info">Command</button>
            <select class="form-select select-domaine" aria-label="example">
                <option selected><?php echo strtoupper($_GET['d']); ?></option>
                <option value="bo">BO</option>
                <option value="bo_lpp">BO_LPP</option>
                <option value="devis">Devis</option>
                <option value="front">FRONT</option>
                <option value="materiel">Materiels</option>
                <option value="hellodevis">Hellodevis</option>
                <option value="materiel">Materiels</option>
                <option value="hellopro_data">Hellopro Data</option>
                <option value="seo">SEO</option>
                <option value="mep">MEP</option>
            </select>
        </ul>
    </div>
    <div class="reponse">
        <h4>Migration php 7 sur le domaine : <?php echo strtoupper($_GET['d']);?></h4>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item folder" data-target="<?php echo $_SERVET['DOCUMENT_ROOT'];?>">Ouvrir la Racine</li>
                <li class="list-group-item folder" data-target="<?php echo $_SERVET['DOCUMENT_ROOT']."\php-5";?>">Ouvrir le repertoire PHP 5</li>
                <li class="list-group-item folder" data-target="<?php echo $_SERVET['DOCUMENT_ROOT']."\php-7";?>">Ouvrir le repertoire PHP 7</li>
                <li class="list-group-item folder" data-target="<?php echo $_SERVET['DOCUMENT_ROOT']."\mep";?>">Ouvrir le repertoire MEP</li>
                <li class="list-group-item btn-danger ferme-migration">Fermer</li>
            </ul>
        </div>
    </div>
    <input type="hidden" value="x55">
    <style>
    .ferme-migration{
        background-color:  #fd0b00!important;
        color:#fff!important
    }
    </style>
    <script>
        if(tab["home"] == "" && historique == ""){
            tab["home"] = $('.reponse').html();
        }
        
    </script>
</div>