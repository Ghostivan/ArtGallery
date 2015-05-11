<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("../../../rel/header.php");
include("../model.php");

        if($_GET){
            if(isset($_POST["submit"])){
               $response =  updateArtist($_POST["nom"], $_POST["prenom"], $_POST["cv"],$_GET["artist"]);
               $oldInfOeuvre = getOeuvresByNameArtist($_POST["nom"]);
               $artist = getArtistByName($_POST["nom"]);
              /* foreach($oldInfOeuvre as $key)
               {
                  //print_r($key);
                  $key["url_oeuvre"] = str_replace($_GET["artist"],$_POST["nom"],$key["url_oeuvre"]);
                  $res = updateOeuvre($artist[0]["id_artist"], $key["url_oeuvre"],$key["nom_oeuvre"]);
               }*/     
               $dir = '../../artistes';
               $files1 = scandir($dir);
               for($i=0;$i< count($files1);$i++){
                    if($_GET["artist"] == $files1[$i]){
                      rename($dir."/".$_GET["artist"] , $dir."/".$_POST["nom"]);
                   }
                }
                header("Location: ../../home.php");
            }else{
                $artist = getArtistByName($_GET["artist"]);
                ?>
            <h2>Modification de l'artiste <?php echo($artist[0]["prenom_artist"]." ".$artist[0]["nom_artist"]); ?></h2>
            <button onclick="location.href= '../../home.php';">Revenir à l'Administration Principale</button>
            <div class="form_model">
                <form  id="modify_artist" method="POST" action="modifyArtist.php?artist=<?php echo($_GET["artist"]); ?>">
                     <fieldset>
                        <label>Prénom</label>
                        <div class="input-control text" data-role="input-control">
                            <input name="prenom" type="text" placeholder="Ex: Ivan..." value="<?php echo($artist[0]["prenom_artist"]); ?>">
                            <button class="btn-clear" tabindex="-1"></button>
                        </div>

                        <label>Nom</label>
                        <div class="input-control text" data-role="input-control">
                            <input name="nom" type="text" placeholder="Ex: Dupont" value="<?php echo($_GET["artist"]); ?>" autofocus="">
                            <button class="btn-clear" tabindex="-1"></button>
                        </div>
                         <div class="tab-control" data-role="tab-control">
                            <label>Description</label>
                             <ul class="tabs">
                                 <li class="active"><a href="#desc_modif_fr"><img src="../../../img/country/fr.png" /></a></li>
                                 <li><a href="#desc_modif_en"><img src="../../../img/country/gb.png" /></a></li>
                                 <li><a href="#desc_modif_ne"><img src="../../../img/country/lu.png" /></a></li>
                             </ul>
                             <div class="frames">
                                 <div class="frame" id="desc_modif_fr">
                                     <div class="input-control textarea">
                                         <textarea id="modifArtistFR" name="cv[0]" placeholder="Pas de description..."><?php if(isset($artist[0]))echo($artist[0]["description_artist"]); ?></textarea>
                                     </div>
                                 </div>
                                 <div class="frame" id="desc_modif_en">
                                     <div class="input-control textarea">
                                         <textarea id="modifArtistEN" name="cv[1]" placeholder="No description..."><?php if(isset($artist[1]))echo($artist[1]["description_artist"]); ?></textarea>
                                     </div>
                                 </div>
                                 <div class="frame" id="desc_modif_ne">
                                     <div class="input-control textarea">
                                         <textarea id="modifArtistNE" name="cv[2]" placeholder="Geen beschrijving..."><?php if(isset($artist[2]))echo($artist[2]["description_artist"]); ?></textarea>                                     </div>
                                 </div>
                            </div>
                        </div>
                        <input name="submit" type="submit" value="Enregistrer" />
                    </fieldset>
                </form>
            </div>
      <script>
            $(document).ready(function(){
                 CKEDITOR.replace('modifArtistFR', {
                     customConfig: '../../../js/config.js'
                 });
                 CKEDITOR.replace('modifArtistEN', {
                     customConfig: '../../../js/config.js'
                 });
                 CKEDITOR.replace('modifArtistNE', {
                     customConfig: '../../../js/config.js'
                 });
             });
      </script>
            <?php
            include("../../../rel/footer.php");
            }
        }
?>

