<?php
if($_POST){
    if(isset($_POST["submit"])){
        $current_name = "artistes/".$_POST['nom'];
        $path_oeuvres = $current_name."/oeuvres/";
        $path_profil = $current_name."/profil/";
        if(getRepository($_POST["nom"])){
            // TRAITEMENT BD ARTISTE
            setArtist($_POST["nom"],$_POST["prenom"],$_POST["cv"]);
            createArtistDirectories($current_name);
            // TRAITEMENT IMAGES
            verificationUpload($path_oeuvres,$path_profil);
        }else{
            echo "<script>alert(\"Attention : L'artiste existe déjà, vous ne pouvez pas créer le même artiste 2 fois.\")</script>"; 
        }
    }
}

?>
<div class="form_model">
    <form id="add_artist" enctype="multipart/form-data" method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <label>Prénom</label>
            <div class="input-control text" data-role="input-control">
                <input name="prenom" type="text" placeholder="Ex: Ivan...">
                <button class="btn-clear" tabindex="-1"></button>
            </div>

            <label>Nom</label>
            <div class="input-control text" data-role="input-control">
                <input name="nom" type="text" placeholder="Ex: Dupont" autofocus="">
                <button class="btn-clear" tabindex="-1"></button>
            </div>
            <div class="tab-control" data-role="tab-control">
               <label>Description</label>
                <ul class="tabs">
                    <li class="active"><a href="#desc_fr"><img src="../img/country/fr.png" /></a></li>
                    <li><a href="#desc_en"><img src="../img/country/gb.png" /></a></li>
                    <li><a href="#desc_ne"><img src="../img/country/lu.png" /></a></li>
                </ul>
                <div class="frames">
                    <div class="frame" id="desc_fr">
                        <div class="input-control textarea">
                            <textarea id="cveditorFR" name="cv[0]" placeholder="Ivan est un développeur parisien et va souvent au mistral ! ... "></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_en">
                        <div class="input-control textarea">
                            <textarea id="cveditorEN" name="cv[1]" placeholder="Ivan est un développeur parisien et va souvent au mistral ! ... "></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_ne">
                        <div class="input-control textarea">
                            <textarea id="cveditorNE" name="cv[2]" placeholder="Ivan est un développeur parisien et va souvent au mistral ! ... "></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <label>Oeuvre principale :</label>
            <div class="input-control file">
                <input name="profil" type="file" data-transform="input-control" />
                <button class="btn-file"></button>
            </div>

            <label>Oeuvres de l'Artiste :</label>
            <div class="input-control file">
                <input type="hidden" name="MAX_FILE_SIZE" value="65536000">
                <input name="oeuvres[]" type="file" multiple="multiple" data-transform="input-control" />
                <button class="btn-file"></button>
            </div>
            <input name="submit" type="submit" value="Enregistrer" />
        </fieldset>
    </form>
</div>