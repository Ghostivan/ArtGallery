<?php
/*
---------------------------
  CONNEXION BASE DE DONNEES  
---------------------------
*/
function connexionDb(){
	try{
        $bdd = new PDO('mysql:host=localhost;dbname=gallery','root', '');
	   $bdd->query('set character_set_client=utf8');
        $bdd->query('set character_set_connection=utf8');
        $bdd->query('set character_set_results=utf8');
        $bdd->query('set character_set_server=utf8');
        return $bdd;
    }catch(Exception $e){
		echo('Erreur : ' . $e->getMessage());
        return false;
	}
}
/*
--------------------------
  VERIFICATION ADMINISTRATEUR  
--------------------------
*/
function verifAdmin($nameUtilisateur,$mdpUtil){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "SELECT * FROM admin WHERE pseudo_admin = :name AND password_admin = :pass"
                );
                $sql->bindParam(':name',$nameUtilisateur);
                $sql->bindParam(':pass',$mdpUtil);
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
--------------------------
  LISTE DES ARTISTES
--------------------------
*/
function getArtist(){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "SELECT * FROM artist, artistdetail WHERE artist.id_artist = artistdetail.id_artist AND id_lang = 1 ORDER BY nom_artist"
                );
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  AJOUTER UN ARTISTE
----------------------------------------------------
*/
function setArtist($name,$surname,$cv){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "INSERT INTO artist VALUES('',:name,:surname)"
                );
                $sql->bindParam(':name',$name);
                $sql->bindParam(':surname',$surname);
                $sql->execute();
                
                for($i=0;$i<3;$i++){
                    if(!empty($cv[$i])){
                        $sql = $db->prepare(
                                "INSERT INTO artistdetail
                                SELECT :i,MAX(id_artist),:cv FROM artist;"
                                );
                        $sql->bindParam(':cv',$cv[$i]);
                        $j=$i+1;
                        $sql->bindParam(':i',$j);
                        $sql->execute();
                    }    
                }
                
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  RECUPERE UN ARTISTE EN FONCTION DE SON NOM
----------------------------------------------------
*/
function getArtistByName($name){
     try{
                $db = connexionDb();
                $sql = $db->prepare(
                      "SELECT * FROM artist a,artistdetail ad WHERE a.id_artist = ad.id_artist AND nom_artist = :name "
                );
                $sql->bindParam(':name',$name);
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  MODIFIER UN ARTISTE
----------------------------------------------------
*/
function updateArtist($name,$firstname,$cv,$oldname){
     try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "UPDATE artist SET nom_artist = :name , prenom_artist = :firstname WHERE nom_artist = :oldname"
                );
                $sql->bindParam(':name',$name);
                $sql->bindParam(':firstname',$firstname);
                $sql->bindParam(':oldname',$oldname);
                $sql->execute();
                
                for($i=0;$i<3;$i++){
                    if(!empty($cv[$i])){
                        $sql = $db->prepare(
                                "UPDATE artistdetail SET description_artist=:cv WHERE id_lang=:lang AND id_artist=(SELECT id_artist FROM artist WHERE nom_artist=:name);"
                                );
                        $sql->bindParam(':cv',$cv[$i]);
                        $j=$i+1;
                        $sql->bindParam(':lang',$j);
                        $sql->bindParam(':name',$name);
                        $sql->execute();
                    }
                }
                
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  SUPPRIME UN ARTISTE
-----------------------------------------
*/
function deleteArtist($name){
        try{
                $db = connexionDb();
                
                $sql = $db->prepare(
                    "DELETE FROM artistdetail WHERE id_artist=(SELECT id_artist FROM artist WHERE nom_artist=:name)"
                );
                $sql->bindParam(':name',$name);
                $sql->execute();
                
                $sql = $db->prepare(
                    "DELETE FROM artist WHERE nom_artist = :name"
                );
                $sql->bindParam(':name',$name);
                $sql->execute();
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  AJOUTER UNE OEUVRE
----------------------------------------------------
*/
function setOeuvre($prix,$dimension,$artist,$isPerso,$idtechnique,$link,$titre="",$description=""){
        try{
                $db = connexionDb();
                $artiste = getArtistByName($artist);
                $sql = $db->prepare(
                    "INSERT INTO oeuvre VALUES('',:url,:prix,:dimension,:isprofil,:id_artist,:id_technique)"
                );
                $sql->bindParam(':url',$link);
                $sql->bindParam(':prix',$prix);
                $sql->bindParam(':dimension',$dimension);
                $sql->bindParam(':isprofil',$isPerso);
                $sql->bindParam(':id_artist',$artiste[0]['id_artist']);
                $sql->bindParam(':id_technique',$idtechnique);
                $sql->execute();
                
                for($i=0;$i<3;$i++){
                        $sql = $db->prepare(
                                "INSERT INTO oeuvredetail SELECT :i,MAX(id_oeuvre),:titre,:description FROM oeuvre"
                        );
                        $j=$i+1;
                        $sql->bindParam(':i',$j);
                        $sql->bindParam(':titre',$titre[$i]);
                        $sql->bindParam(':description',$description[$i]);
                        $sql->execute();
                }
                
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  MODIFIER UNE OEUVRE UNIQUEMENT LE LIEN
----------------------------------------------------
*/
function updateOeuvre($id,$newLink,$nameOeuvre){
     try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "UPDATE oeuvre "
                  . "SET link_oeuvre = :newLink "
                  . "WHERE oeuvre.id_artist "
                  . "IN ( "
                  . "SELECT id_artist "
                  . "FROM artist "
                  . "WHERE id_artist = :id "
                  . ") "
                  . "AND titre_oeuvre = :nameOeuvre "
                );
                $sql->bindParam(':newLink',$newLink);
                $sql->bindParam(':id',intval($id));
                $sql->bindParam(':nameOeuvre',$nameOeuvre);
                $sql->execute();
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
----------------------------------------------------
  MODIFIER UNE OEUVRE PAR LE FORMULAIRE
----------------------------------------------------
*/
function updateOeuvreBis($prix,$dimension,$isProfil,$idtech,$idoeuvre,$titre,$description){
            try{
            $db = connexionDb();
            
            for($i=0;$i<3;$i++){
                    $sql = $db->prepare(
                            "UPDATE oeuvredetail SET nom_oeuvre=:titre,description_oeuvre=:description WHERE id_lang=:idlang AND id_oeuvre=:idoeuvre;"
                    );
                    $j=$i+1;
                    $sql->bindParam(':idlang',$j);
                    $sql->bindParam(':idoeuvre',$idoeuvre);
                    $sql->bindParam(':titre',$titre[$i]);
                    $sql->bindParam(':description',$description[$i]);
                    $sql->execute();
            }
            
            $sql = $db->prepare(
                        "UPDATE oeuvre SET prix_oeuvre=:prix,dimension_oeuvre=:dimension,isProfil_oeuvre=:isProfil,id_technique=:idtech WHERE id_oeuvre=:idoeuvre;"
                    );
            $sql->bindParam(':prix',$prix);
            $sql->bindParam(':dimension',$dimension);
            $sql->bindParam(':isProfil',$isProfil);
            $sql->bindParam(':idtech',$idtech);
            $sql->bindParam(':idoeuvre',$idoeuvre);
            $sql->execute();
            
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        } 
}
/*
----------------------------------------------------
  MODIFIER UNE OEUVRE UNIQUEMENT LE LIEN
----------------------------------------------------
*/
function updateOeuvreFinish($titre,$price,$description,$dimension,$technique){
     try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "UPDATE oeuvre "
                  . "SET prix_oeuvre = :price , description_oeuvre = :description , dimensions_oeuvre = :dimension , id_technique = :idtech "
                  . "WHERE titre_oeuvre = :titre "
                );
                $sql->bindParam(':price',intval($price));
                $sql->bindParam(':description',$description);
                $sql->bindParam(':dimension',$dimension);
                $sql->bindParam(':idtech',intval($technique));
                $sql->bindParam(':titre',$titre);
                $sql->execute();
        }catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  RECUPERE LES OEUVRES
-----------------------------------------
*/
function getOeuvres(){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                   "SELECT * FROM oeuvre,oeuvredetail,technique,artist "
                  ."WHERE oeuvre.id_technique = technique.id_technique "
                  . " AND oeuvre.id_oeuvre = oeuvredetail.id_oeuvre "
                  . " AND oeuvre.id_artist = artist.id_artist"      
                  . " AND id_lang = 1"
                );
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  RECUPERE LES OEUVRES D'UN ARTISTE
-----------------------------------------
*/
function getOeuvresByArtist($id){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "SELECT * FROM oeuvre WHERE id_artist = :id"
                );
                $sql->bindParam(':id',$id);
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  RECUPERE LES OEUVRES D'UN ARTISTE
-----------------------------------------
*/
function getOeuvresByNameArtist($name){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "SELECT * FROM oeuvre,artist WHERE oeuvre.id_artist = artist.id_artist AND artist.nom_artist = :name"
                );
                $sql->bindParam(':name',$name);
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  SUPPRIME LES OEUVRES D'UN NOM ARTISTE
-----------------------------------------
*/
function deleteOeuvresByArtist($id){
        try{
                $db = connexionDb();
                
                $sql = $db->prepare(
                    "DELETE FROM oeuvredetail WHERE id_oeuvre IN (SELECT id_oeuvre FROM oeuvre WHERE id_artist=:id); "
                );
                $sql->bindParam(':id',$id);
                $sql->execute();
                
                $sql = $db->prepare(
                    "DELETE FROM oeuvre WHERE id_artist=:id"
                );
                $sql->bindParam(':id',$id);
                $sql->execute();
        }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
-----------------------------------------
  SUPPRIME UNE OEUVRE PAR ID
-----------------------------------------
*/
function deleteOeuvre($id){
    try{
        
        $db = connexionDb();
        $sql = $db->prepare(
                "SELECT * FROM oeuvre o,artist a WHERE id_oeuvre=:id AND o.id_artist=a.id_artist;"
                );
        $sql->bindParam(':id',$id);
        $sql->execute();
        $oeuvre = $sql->fetchAll();
        $dossier = $oeuvre[0]['isProfil_oeuvre'] == 1 ? 'profil' : 'oeuvres';
        unlink('artistes/'.$oeuvre[0][nom_artist].'/'.$dossier.'/'.$oeuvre[0][url_oeuvre]);

        
        $sql = $db->prepare(
                    "DELETE FROM oeuvredetail WHERE id_oeuvre=:id; "
                );
        $sql->bindParam(':id',$id);
        $sql->execute();
        
        $sql = $db->prepare(
                    "DELETE FROM oeuvre WHERE id_oeuvre=:id;"
                );
        $sql->bindParam(':id',$id);
        $sql->execute();
    
    } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
    }
}
/*
-----------------------------------------
  RECUPERE LES TECHNIQUES
-----------------------------------------
*/
function getTechniques(){
        try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "SELECT * FROM technique"
                );
                $sql->execute();
                $donnee = $sql->fetchAll();
                return $donnee;
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}
/*
--------------------------------
  UPDATE INFORMATIONS ENTREPRISE
--------------------------------
*/
function setInfosEntreprise($id,$name,$adr_rue,$adr_cp,$adr_ville,$tel,$mail,$siret){
    try{
                $db = connexionDb();
                $sql = $db->prepare(
                    "UPDATE entreprise SET nom_entreprise = :name , tel_entreprise= :tel , adr_rue_entreprise = :adr_rue , adr_cp_entreprise = :adr_cp , adr_ville_entreprise = :adr_ville , mail_entreprise = :mail , siret_entreprise = :siret WHERE id_entreprise = :id "
                );
                $sql->bindParam(':id',$id);
                $sql->bindParam(':name',$name);
                $sql->bindParam(':tel',$tel);
                $sql->bindParam(':adr_rue',$adr_rue);
                $sql->bindParam(':adr_cp',$adr_cp);
                $sql->bindParam(':adr_ville',$adr_ville);
                $sql->bindParam(':mail',$mail);
                $sql->bindParam(':siret',$siret);
                $sql->execute();  
            }
        catch(PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }   
}

/*
--------------------------------
  UPDATE INFORMATIONS ENTREPRISE
--------------------------------
*/

function getOeuvreById($id){
try{
               $db = connexionDb();
               $sql = $db->prepare(
                   "SELECT * FROM oeuvre o,oeuvredetail od WHERE o.id_oeuvre = od.id_oeuvre AND o.id_oeuvre=:id"
               );
               $sql->bindParam(':id',$id);
               $sql->execute();
               $donnee = $sql->fetchAll();
               return $donnee;
           }
       catch(PDOException $e){
           print "Erreur !: " . $e->getMessage() . "<br/>";
           die();
       }      
}
?>