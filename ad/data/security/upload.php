<?php
$list_artist = getArtist();
$list_oeuvres = getOeuvres();
function verificationUpload($_path_oeuvres,$_path_profil){
    if($_FILES){
        $list_oeuvre = $_FILES["oeuvres"];
        $profil = $_FILES["profil"];
        if ($_FILES['oeuvres']['error']) {     
            switch ($_FILES['oeuvres']['error']){     
                case 1: // UPLOAD_ERR_INI_SIZE     
                        echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";     
                        break;     
                case 2: // UPLOAD_ERR_FORM_SIZE     
                        echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !"; 
                        break;     
                case 3: // UPLOAD_ERR_PARTIAL     
                        echo "L'envoi du fichier a été interrompu pendant le transfert !";     
                        break;     
                case 4: // UPLOAD_ERR_NO_FILE     
                        echo "Le fichier que vous avez envoyé a une taille nulle !"; 
                        break;
                default:{
                        traitementOeuvres($_path_oeuvres,$list_oeuvre);
                        traitementProfil($_path_profil,$profil,1);
                        break;
                }
            }     
        }
    }
}
function createArtistDirectories($_path){
      mkdir($_path, 0700);
      mkdir($_path."/profil", 0700);
      mkdir($_path."/oeuvres", 0700);
}
function traitementOeuvres($chemin_destination,$files){
    if(count($files["name"]) == 0){
        return 0;
    }else{
    // Traitement images
        for($i=0;$i < count($files["name"]);$i++){
            $target_file = $chemin_destination.basename($files["name"][$i]);
            if ((isset($files['tmp_name'][$i]))){          
                move_uploaded_file($files['tmp_name'][$i], $target_file);
                if(isset($_POST["artist"])){
                    $nomArt = $_POST["artist"];
                }
                if(isset($_POST["nom"])){
                    $nomArt = $_POST['nom'];
                }
                //setOeuvre($files["name"][$i],$target_file,$_POST['nom'],1,0);
                setOeuvre("","",$_POST["nom"],0,1,$files["name"][$i]);
            }else{
                echo("ERROR: UPLOAD DOESN'T WORK ! ");
            }
        }
    }
}
function traitementProfil($chemin_destination,$files,$isProfil){
    if(count($files["name"]) == 0){
        return 0;
    }else{
        // Traitement image de profil artiste
        $target_file = $chemin_destination.basename($files["name"]);
        if ((isset($files['tmp_name']))){          
            move_uploaded_file($files['tmp_name'], $target_file);
            if(isset($_POST["artist"])){
                $nomArt = $_POST["artist"];
            }
            if(isset($_POST["nom"])){
                $nomArt = $_POST['nom'];
            }
            //setOeuvre($files["name"],$target_file,$nomArt,1,$isProfil);
            setOeuvre("","",$_POST["nom"],1,1,$files["name"]);
        }else{
            echo("ERROR: UPLOAD DOESN'T WORK ! ");
        }
    }
}
function getRepository($_name){
    $directories = glob('artistes/*' , GLOB_ONLYDIR);
    foreach($directories as $dir){
        $name = str_replace("artistes/","",$dir);
        if($_name == $name){
            return false;
        }
    }
    return true;
}
function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir); 
        foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
                if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
            } 
        } 
    reset($objects); 
    rmdir($dir); 
    } 
}
?>