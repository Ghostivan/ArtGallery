<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<i class="icon-warning" style="color:red;"></i><br />
<span>Votre mot de passe doit être <b>sécurisé</b>.<br /> Il doit contenir des caractères minuscules et majuscules, des nombres et caractères spéciaux.<br />
Au minimum le mot de passe doit faire <b>7 caractères</b>.
<br />
Exemple de mot de passe <b style="color:green">sécurisé </b>: <br />
<i>1secreT=1945</i>
<br />
Exemple de mot de passe <b style="color:red">non sécurisé</b> :<br />
<i>IvanKlar</i><br />
<i>1238479</i><br />
<i>Iv18814</i><br />

</span>
<div class="form_model">
    <form id="add_artist" enctype="multipart/form-data" method="POST" action="addFormArtist.php">
        <fieldset>
            <label>Nouveau Mot de Passe</label>
            <div class="input-control text" data-role="input-control">
                <input name="newMdp" type="password" placeholder="...">
                <button class="btn-clear" tabindex="-1"></button>
            </div>
            <input name="submit" type="submit" value="Enregistrer" />
        </fieldset>
    </form>
</div>