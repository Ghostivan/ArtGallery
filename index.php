<?php
   include("rel/header.php");   
?>
<div id="main">
    <div class="video-bloc">
        <center>
            <video width="1000px" height="500px" controls>
              <source src="video/news_video.mp4" type="video/mp4">
            </video>
        </center>
    </div>
     <div class="infos-bloc">
       <!--<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2622.6999669830884!2d2.3428350999999936!3d48.902054899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s99+Rue+des+Rosiers+Saint-Ouen!5e0!3m2!1sfr!2sfr!4v1428237293302" width="100%" height="300" frameborder="0" style="border:0"></iframe>
       -->
       <h2><?php echo $obj[$lang][2]["information"] ?></h2>
       <center>
           <img class="shop" src="img/shop.png" alt="Where"/>
       </center>
       <p>Marché Vernaison </br>
            99 Rue des Rosiers </br>
            136 Boulevard Michelet </br>
            Allée 1, Stand 18 </br>
            93 400 Saint-Ouen </br>
       </p>
      
    </div>
    <div class="gallery-artist">
        <h2><?php echo $obj[$lang][1]["artist"]["title"] ?></h2><br />
        <hr />
            <h3 class="title-artist"><?php echo $obj[$lang][1]["artist"]["itinerant"] ?></h3>
        <hr />
        <div class="artist-bloc">
            <h3>Christian Ferdinand</h3>
            <img class="zoom" src="img/peinture.jpg" alt="Ivan KLARMAN" />
        </div>
        <div class="artist-bloc">
            <h3>Kazem</h3>
            <img class="zoom" src="img/peinture2.jpg" alt="Ivan KLARMAN" />
        </div>
       <div class="artist-bloc">
            <h3>Cécile Marchand</h3>
            <img class="zoom" src="img/peinture3.jpg" alt="Ivan KLARMAN" />
        </div>
        <div class="artist-bloc">
            <h3>Lena Golovina</h3>
            <img class="zoom" src="img/peinture4.jpg" alt="Lena Golovina" />
        </div>
        
        <div class="artist-bloc">
            <h3>Manon Dgn</h3>
            <img class="zoom" src="img/peinture5.jpg" alt="Lena Golovina" />
        </div>
        
        <div class="artist-bloc zoom">
            <h3>Olivier Menu</h3>
            <img class="zoom" src="img/peinture6.jpg" alt="Lena Golovina" />
        </div>
        
        <div class="artist-bloc">
            <h3>Harouna Ouedraogo</h3>
            <img class="zoom" src="img/peinture7.jpg" alt="Lena Golovina" />
        </div>
        <div class="clear"></div>
        <br />
        <hr />
            <h3 class="title-artist"><?php echo $obj[$lang][1]["artist"]["espoir"] ?></h3>
        <hr />
        <div class="artist-bloc">
            <h3>Manon Dgn</h3>
            <img  class="zoom" src="img/peinture5.jpg" alt="Lena Golovina" />
        </div>
        
        <div class="artist-bloc">
            <h3>Olivier Menu</h3>
            <img  class="zoom" src="img/peinture6.jpg" alt="Lena Golovina" />
        </div>
        
        <div class="artist-bloc" >
            <h3>Harouna Ouedraogo</h3>
            <img class="zoom" src="img/peinture7.jpg" alt="Lena Golovina" />
        </div>
        <div class="clear"></div>
    </div>
    <div class="infos-bloc">
        <img src="img/map2.png" />
    </div>
</div>

<?php
   include("rel/footer.php");
?>
