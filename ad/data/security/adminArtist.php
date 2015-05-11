<?php
    include("upload.php");
        if($_POST){
            if(isset($_POST["deleteA"])){
                $artistToDel = $_POST["deleteA"];
                $artiste = getArtistByName($artistToDel);
               // deleteOeuvresByArtist($artiste[0]["id_artist"]);
               // echo($artiste[0]["nom_artist"]);
                deleteArtist($artistToDel);
               // echo($artist[0]["nom_artist"]);
                rrmdir("artistes/".$artistToDel);
                header('Location: '.$_SERVER['REQUEST_URI']);
                $_POST["deleteA"] = NULL;
            }else if(isset($_POST["updateA"])){
                header("Location: ../ad/data/security/modifyArtist.php?artist=".$_POST["updateA"]."");
            }else if(isset($_POST["updateO"])){
                header("Location: ../ad/data/security/modifyOeuvre.php?oeuvre=".$_POST["updateO"]."");
            }else if(isset($_POST["deleteO"])){/*
                $artistToDel = $_POST["deleteO"];
                $artiste = getArtistByName($artistToDel);
                deleteOeuvresByArtist($artiste[0]["id_artist"]);
                deleteArtist($artistToDel);
                rrmdir("artistes/".$artistToDel."/".);
                header('Location: '.$_SERVER['REQUEST_URI']);
                $_POST["deleteO"] = NULL;*/
                
                deleteOeuvre($_POST['deleteO']);
                header('Location: '.$_SERVER['REQUEST_URI']);
            }else{
                
            }
        }

?>
    <form id="admin_dashboard" enctype="multipart/form-data" method="POST">
        <div class="tab-control" data-role="tab-control">
            <ul class="tabs">
                <li><a href="#_page_1">Artistes</a></li>
                <li><a href="#_page_2">Oeuvres</a></li>
                <li><a href="#_page_3">Vidéo</a></li>
                <li class="place-right"><a href="#_page_4">Paramètres du site</a></li>
            </ul>

            <div class="frames">
                <div class="frame" id="_page_1">
                    <div class="panel" data-role="panel">
                        <div class="panel-header">
                           Liste des Artistes
                        </div>
                        <div class="panel-content list-scrolling" style="display:none;">
                            <table class="table list">
                                <thead>
                                    <tr>
                                        <th class="text-left">Nom</th>
                                        <th class="text-left">Prénom</th>
                                        <th class="text-left">Descriptions</th>
                                        <th class="text-left">Actions</th></tr>
                                </thead>
                                <?php
                                foreach($list_artist as $key)
             
                                        echo("<tr>"
                                        . "<td>".$key["nom_artist"]."</td>"
                                        . "<td>".$key["prenom_artist"]."</td>"
                                        . "<td class='sizeColumnDesc' >".$key["description_artist"]."</td>"
                                        . "<td>"
                                            . "<button class='info' name='updateA' value='".$key["nom_artist"]."'>Modifier</button>"
                                            . "<button class='danger' name='deleteA' value='".$key["nom_artist"]."'>Supprimer</button>"
                                        . "</td>"
                                        . "</tr>");
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="panel" data-role="panel">
                        <div class="panel-header">
                               Ajouter un Artiste
                        </div>
                        <div class="panel-content list-scrolling" style="display:none;">
                            <?php include("addFormArtist.php"); ?>  
                        </div>
                    </div>
                </div>
                <div class="frame" id="_page_2">
                    <div class="panel" data-role="panel">
                        <div class="panel-header">
                           Liste des Oeuvres
                        </div>
                        <div class="panel-content list-scrolling" style="display:none;">
                            <table class="table list">
                                <thead>
                                    <tr>
                                        <th class="text-left">Entête</th>
                                        <th class="text-left">Visuel</th>
                                        <th class="text-left">Artiste</th>
                                        <th class="text-left">Titre</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Technique</th>
                                        <th class="text-left">Prix</th>
                                        <th class="text-left">Actions</th></tr>
                                </thead>
                            <?php
                            foreach($list_oeuvres as $key){
                                    if($key["isProfil_oeuvre"] == 1){
                                        $tmpStr = "<td><center><i class='icon-eye-2' style='color:#31B404;font-size:40px;'></i></center></td>"; 
                                        $link = $key["nom_artist"]."/profil/".$key["url_oeuvre"];
                                    }else{
                                        $tmpStr = "<td></td>";
                                        $link = $key["nom_artist"]."/oeuvres/".$key["url_oeuvre"];
                                    }
                                    /*$tab = ["nom_oeuvre","description_oeuvre","nom_technique","prix_oeuvre"];
                                    foreach ($tab as $prop){
                                        if($key[$prop] == NULL)
                                            $key[$prop] = " ";
                                    }*/
                                    
                                    echo("<tr>".$tmpStr
                                    . "<td>"
                                    . "<img height='250px' width='100px' src='artistes/".$link."'/>"
                                    . "</td>"
                                    . "<td>".$key["nom_artist"]."</td>"
                                    . "<td>".$key["nom_oeuvre"]."</td>"
                                    . "<td>".$key["description_oeuvre"]."</td>"
                                    . "<td>".$key["libelle_technique"]."</td>"
                                    . "<td>".$key["prix_oeuvre"]." €</td>"
                                    . "<td>"
                                    . "<button name='updateO' class='info' value='".$key["id_oeuvre"]."'>Modifier</button>"
                                    . "<button name='deleteO' class='danger' value='".$key["id_oeuvre"]."'>Supprimer</button>"
                                    . "</td>"
                                    . "</tr>");
                            }
                            ?>
                            </table>
                        </div>
                     </div>
                     <div class="panel" data-role="panel">
                        <div class="panel-header">
                               Ajouter une Oeuvre
                        </div>
                        <div class="panel-content list-scrolling" style="display:none;">
                            <?php include("addFormOeuvre.php"); ?>  
                        </div>
                    </div>
                </div>
                 <div class="frame" id="_page_3">
                    <div class="panel" data-role="panel">
                        <div class="panel-header">
                           Changer la vidéo
                        </div>
                        <div class="panel-content param_video">
                             <button form="admin_dashboard" class="image-button transparent bg-black fg-white" name="fichier" type="file" size="100" maxlength="150" accept="text/*">
                                 <b>Charger une nouvelle vidéo  <br /></b>
                                 <img src="<?php echo($URI."img/icon_dwn.png"); ?>" class=" bg-red fg-white">
                            </button>
                             <video width="500px" height="250px" controls>
                                <source src="<?php echo($URI."video/news_video.mp4");?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
                <div class="frame" id="_page_4">
                    <div class="panel" data-role="panel">
                        <div class="panel-header">
                           Changer le mot de passe
                        </div>
                        <div class="panel-content">
                            <?php include("changemdp.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>