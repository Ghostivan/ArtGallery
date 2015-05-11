<?php

if($_POST){
    if(isset($_POST["submitOeuvre"])){
        $current_name = "artistes/".$_POST['artist'];
        $path_oeuvres = $current_name."/oeuvres/";
        $path_profil = $current_name."/profil/";
        $file = $_FILES["oeuvre"];
        
        setOeuvre($_POST['prix'],$_POST['dimension'],$_POST['artist'],isset($_POST['isProfil']) ? 1 : 0,$_POST['technique'],$file['name'],$_POST['titre'],$_POST['descriptionOeuvre']);
        
        if(isset($_POST['isProfil'])){
            // Profil

            $urlFile = $path_profil.basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $urlFile);
        }else{
            // Oeuvre

            $urlFile =$path_oeuvres.basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $urlFile);
        }
        //traitementProfil($path_profil,$file,isset($_POST["isProfil"])? 1 : 0);
        //updateOeuvreFinish($file["name"],$_POST['titre'],$_POST["prix"],$_POST["descriptionOeuvre"],$_POST["dimension"], $_POST["technique"]);*/
    }
}
?>
<div class="form_model">
    <form id="add_oeuvre" enctype="multipart/form-data" method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <fieldset> 
            <div class="tab-control" data-role="tab-control">
               <label>Titre de l'oeuvre</label>
                <ul class="tabs">
                    <li class="active"><a href="#desc_to_fr"><img src="../img/country/fr.png" /></a></li>
                    <li><a href="#desc_to_en"><img src="../img/country/gb.png" /></a></li>
                    <li><a href="#desc_to_ne"><img src="../img/country/lu.png" /></a></li>
                </ul>
                <div class="frames">
                    <div class="frame" id="desc_to_fr">
                        <div class="input-control textarea">
                            <input type="text" name="titre[0]" />
                        </div>
                    </div>
                    <div class="frame" id="desc_to_en">
                        <div class="input-control textarea">
                            <input type="text" name="titre[1]" />
                        </div>
                    </div>
                    <div class="frame" id="desc_to_ne">
                        <div class="input-control textarea">
                            <input type="text" name="titre[2]" />
                        </div>
                    </div>
                </div>
            </div>

            <label>Artiste</label>
            <div class="input-control select">
                <select name="artist">
                    <?php 
                        $listArtist = getArtist();
                        foreach($listArtist as $key){
                            echo("<option value='".$key["nom_artist"]."'>".$key["nom_artist"]."</option>");
                        }
                    ?>
                </select>
            </div>
            <label>Dimensions</label>
            <div class="input-control text" data-role="input-control">
                <input name="dimension" type="text" placeholder="hauteur x largeur  Exemple : 150 x 200">
                <button class="btn-clear" tabindex="-1"></button>
            </div>
            <label>Technique</label>
            <div class="input-control select">
                <select name="technique">
                    <?php 
                        $listTechnique = getTechniques();
                        foreach($listTechnique as $key){
                            echo("<option value='".$key["id_technique"]."'>".$key["libelle_technique"]."</option>");
                        }
                    ?>
                </select>
            </div>
            <label>Prix</label>
            <div class="input-control textarea">
               <input type="number" name="prix" min="0" max="100000000" size="6" /> €
            </div>
             <div class="tab-control" data-role="tab-control">
               <label>Description</label>
                <ul class="tabs">
                    <li class="active"><a href="#desc_o_fr"><img src="../img/country/fr.png" /></a></li>
                    <li><a href="#desc_o_en"><img src="../img/country/gb.png" /></a></li>
                    <li><a href="#desc_o_ne"><img src="../img/country/lu.png" /></a></li>
                </ul>
                <div class="frames">
                    <div class="frame" id="desc_o_fr">
                        <div class="input-control textarea">
                            <textarea id="oeuvreFR" name="descriptionOeuvre[0]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... "></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_o_en">
                        <div class="input-control textarea">
                            <textarea id="oeuvreEN" name="descriptionOeuvre[1]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... "></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_o_ne">
                        <div class="input-control textarea">
                            <textarea id="oeuvreNE" name="descriptionOeuvre[2]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... "></textarea>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="input-control checkbox">
                <label>
                  Cochez la case s'il s'agit d'une oeuvre d'entête d'un artiste : <br />
                    <input type="checkbox" name="isProfil"/>
                    <span class="check"></span>
                </label>
            </div>
            <label>Image :</label>
            <div class="input-control file">
                <input type="hidden" name="MAX_FILE_SIZE" value="65536000">
                <input name="oeuvre" type="file" data-transform="input-control" />
                <button class="btn-file"></button>
            </div>
            <br /><br />
            <input name="submitOeuvre" type="submit" value="Enregistrer" />
        </fieldset>
    </form>
</div>