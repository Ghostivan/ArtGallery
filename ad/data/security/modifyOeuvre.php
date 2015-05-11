<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("../../../rel/header.php");
if($_GET){
    include("../model.php");
    if(isset($_POST['submitUpdateOeuvre'])){
        updateOeuvreBis($_POST['prix'],$_POST['dimension'],isset($_POST['isProfil']) ? 1 : 0,$_POST['technique'],$_GET['oeuvre'],$_POST['titre'],$_POST['descriptionOeuvre']);
        header("Location: ../../home.php");
        
    }
    $oeuvre = getOeuvreById($_GET["oeuvre"]);
    ?>
<div class="form_model">
    <form  id="modify_oeuvre" method="POST" action="modifyOeuvre.php?oeuvre=<?php echo $_GET['oeuvre']; ?>">
         <fieldset>
           <div class="tab-control" data-role="tab-control">
               <label>Titre de l'oeuvre</label>
                <ul class="tabs">
                    <li class="active"><a href="#desc_to_fr"><img src="../../../img/country/fr.png" /></a></li>
                    <li><a href="#desc_to_en"><img src="../../../img/country/gb.png" /></a></li>
                    <li><a href="#desc_to_ne"><img src="../../../img/country/lu.png" /></a></li>
                </ul>
                <div class="frames">
                    <div class="frame" id="desc_to_fr">
                        <div class="input-control textarea">
                            <input type="text" name="titre[0]" value="<?php echo $oeuvre[0]['nom_oeuvre']; ?>"/>
                        </div>
                    </div>
                    <div class="frame" id="desc_to_en">
                        <div class="input-control textarea">
                            <input type="text" name="titre[1]"  value="<?php echo $oeuvre[1]['nom_oeuvre']; ?>"/>
                        </div>
                    </div>
                    <div class="frame" id="desc_to_ne">
                        <div class="input-control textarea">
                            <input type="text" name="titre[2]"  value="<?php echo $oeuvre[2]['nom_oeuvre']; ?>"/>
                        </div>
                    </div>
                </div>
            </div>

            <label>Artiste</label>
            <div class="input-control select">
                <select name="artist" disabled>
                    <?php 
                        $listArtist = getArtist();
                        foreach($listArtist as $key){
                            $selected = "";
                            if($key["id_artist"]==$oeuvre[0]['id_artist']){
                                $selected = "selected";
                            }
                            echo("<option ".$selected." value='".$key["nom_artist"]."'>".$key["nom_artist"]."</option>");
                        }
                    ?>
                </select>
            </div>
            <label>Dimensions</label>
            <div class="input-control text" data-role="input-control">
                <input name="dimension" type="text" placeholder="hauteur x largeur  Exemple : 150 x 200" value="<?php echo $oeuvre[0]['dimension_oeuvre']; ?>">
                <button class="btn-clear" tabindex="-1"></button>
            </div>
            <label>Technique</label>
            <div class="input-control select">
                <select name="technique">
                    <?php 
                        $listTechnique = getTechniques();
                        foreach($listTechnique as $key){
                            $selected = "";
                            if($key["id_technique"]==$oeuvre[0]['id_technique']){
                                $selected = "selected";
                            }
                            echo("<option ".$selected." value='".$key["id_technique"]."'>".$key["libelle_technique"]."</option>");
                        }
                    ?>
                </select>
            </div>
            <label>Prix</label>
            <div class="input-control textarea">
               <input type="number" name="prix" min="0" max="100000000" size="6" value="<?php echo $oeuvre[0]['prix_oeuvre']; ?>"/> €
            </div>
             <div class="tab-control" data-role="tab-control">
               <label>Description</label>
                <ul class="tabs">
                    <li class="active"><a href="#desc_o_fr"><img src="../../../img/country/fr.png" /></a></li>
                    <li><a href="#desc_o_en"><img src="../../../img/country/gb.png" /></a></li>
                    <li><a href="#desc_o_ne"><img src="../../../img/country/lu.png" /></a></li>
                </ul>
                <div class="frames">
                    <div class="frame" id="desc_o_fr">
                        <div class="input-control textarea">
                            <textarea id="modifOeuvreFR" name="descriptionOeuvre[0]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... " ><?php echo $oeuvre[0]['description_oeuvre']; ?></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_o_en">
                        <div class="input-control textarea">
                            <textarea id="modifOeuvreEN" name="descriptionOeuvre[1]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... " ><?php echo $oeuvre[1]['description_oeuvre']; ?></textarea>
                        </div>
                    </div>
                    <div class="frame" id="desc_o_ne">
                        <div class="input-control textarea">
                            <textarea id="modifOeuvreNE" name="descriptionOeuvre[2]" placeholder="Les époux Arnolfini est une oeuvre de Jan Van Eyck de 1434 ... " ><?php echo $oeuvre[2]['description_oeuvre']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="input-control checkbox">
                <label>
                  Cochez la case s'il s'agit d'une oeuvre d'entête d'un artiste : <br />
                    <input type="checkbox" name="isProfil" <?php if($oeuvre[0]['isProfil_oeuvre'] == 1) echo "checked"; ?>/>
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
            <input name="submitUpdateOeuvre" type="submit" value="Enregistrer" />
         </fieldset>
    </form>
</div>
<script>
       $(document).ready(function(){
            CKEDITOR.replace('modifOeuvreFR', {
                customConfig: '../../../js/config.js'
            });
            CKEDITOR.replace('modifOeuvreEN', {
                customConfig: '../../../js/config.js'
            });
            CKEDITOR.replace('modifOeuvreNE', {
                customConfig: '../../../js/config.js'
            });
        });
 </script>
<?php
include("../../../rel/footer.php");
}
?>

