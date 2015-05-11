<!DOCTYPE html>
<!--
    Created on : 2 avr. 2015, 20:25:41
    Author     : Navi
-->
<?php
   if(empty($_GET["lang"])){
        $_GET["lang"] = "EN";
   }
   $lang = $_GET["lang"];
   $URI = "http://".$_SERVER['HTTP_HOST']."/ArtGallery/";
   $packLanguage = file_get_contents($URI."lang/ressources.json");
   $obj = json_decode($packLanguage,true);
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thea's Art Gallery</title>
        <!-- CSS -->
        <link href="<?php echo $URI."css/metro-bootstrap.css" ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $URI."css/main.css" ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $URI."css/iconFont.min.css" ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $URI."/js/ckeditor.js" ?>"></script>
        <script type="text/javascript" src="<?php echo $URI."js/ArtGallery.js"?>"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        
    </head>
    <body class="metro">
        <nav class="navigation-bar">
            <nav class="navigation-bar-content">
                <a class="element brand" href="#"><span><?php echo $obj[$lang][0]["Navigation"]["gallery"] ?></span></a>
                <span class="element-divider"></span>
                <a class="element brand" href="#"><span><?php echo $obj[$lang][0]["Navigation"]["event"] ?></span></a>
                <span class="element-divider"></span>
                <a class="element brand" href="#"><span><?php echo $obj[$lang][0]["Navigation"]["press"] ?></span></a>
                <span class="element-divider"></span>
                <a class="element brand" href="#"><span><?php echo $obj[$lang][0]["Navigation"]["contact"] ?></span></a>
                <span class="element-divider"></span>
                <div class="element input-element place-right">
                    <form>
                        <div class="input-control text">
                            <input type="text" placeholder="<?php echo $obj[$lang][0]["Navigation"]["search"]?>">
                            <button class="btn-search"></button>
                        </div>
                    </form>
                </div>
                <div class="element place-right bloc-lang">

                    <a class="dropdown-toggle" href="#">
                        <b><?php echo $obj[$lang][0]["Navigation"]["lang"]["lang"] ?></b>
                    </a> 
                    <ul class="lang dropdown-menu place-right" data-role="dropdown">
                        <li><a href="#" onclick="changetoFrench()"><img src="<?php echo $URI."img/country/fr.png" ?>" alt="Français" /><?php echo $obj[$lang][0]["Navigation"]["lang"]["fr"] ?></a></li>
                        <li><a href="#" onclick="changetoEnglish()"><img src="<?php echo $URI."img/country/gb.png" ?>" alt="English" /><?php echo $obj[$lang][0]["Navigation"]["lang"]["en"] ?></a></li>
                        <li><a href="#" onclick="changetoNetherland()"><img src="<?php echo $URI."img/country/lu.png" ?>" alt="Netherlands" /><?php echo $obj[$lang][0]["Navigation"]["lang"]["nl"] ?></a></li>
                    </ul>
                </div>
                
            </nav>
        </nav>