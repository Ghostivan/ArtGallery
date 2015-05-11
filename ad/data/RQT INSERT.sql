	--- Exemple ---

---- FORMULAIRE ARTIST ----

INSERT INTO artiste(nom_artiste) VALUES('Tang');
INSERT INTO artistdetail
SELECT id_lang,MAX(id_artist),'Les bonbons jadore' FROM artist,langue WHERE ext_lang='fr';

-- Oeuvre principale
INSERT INTO oeuvre 
SELECT '',NULL,NULL,1,MAX(id_artist),1
FROM artist;

-- Oeuvre secondaire

INSERT INTO oeuvre 
SELECT '',NULL,NULL,0,MAX(id_artist),1
FROM artist;


---- FORMULAIRE OEUVRE ----


INSERT INTO oeuvre VALUES('','10000','100x100',1,1,1);

INSERT INTO oeuvredetail 
SELECT id_lang,MAX(id_oeuvre),'La joie','Il fait beau ici.'
FROM oeuvre,langue
WHERE ext_lang='fr';


---- FORMULAIRE NEWS ----


INSERT INTO news VALUES('',NOW());

INSERT INTO newsdetails
SELECT MAX(id_news),id_lang,'Le nouveau Peintre !','Il est grand et fabuleux'
FROM news,langue
WHERE ext_lang='fr';

