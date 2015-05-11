    <footer>
        <h3>
            &copy Thea Muck - Thea's Art Gallery <br />
            <b>Achieved by <a href="http://ivanklarman.fr/">Ivan KLARMAN</a></b>
        </h3>
        
    </footer>
    <!-- JS -->
    <script type="text/javascript" src="<?php echo $URI."js/jquery.widget.min.js" ?>"></script>
    <script type="text/javascript" src="<?php echo $URI."js/metro.min.js" ?>"></script>

    <!-- LANGUES -->
    <script type="text/javascript">

    function changetoEnglish(){
        insertParamToUrl("lang","EN");   
    }
    function changetoFrench(){
        insertParamToUrl("lang","FR");   
    }
    function changetoNetherland(){
        insertParamToUrl("lang","NL");   
    }
    </script>
    <!-- ZOOM -->
    <script type="text/javascript" src="<?php echo $URI."js/wheelzoom.js"?>"></script>
    <script>
   $( document ).ready(function() {
       $l_img = $(".zoom");
       $l_img.each(function() {
            wheelzoom($(this));
       });
       
       CKEDITOR.replace('cveditorFR', {
            customConfig: '../js/config.js'
        });
        CKEDITOR.replace('cveditorEN', {
            customConfig: '../js/config.js'
        });
        CKEDITOR.replace('cveditorNE', {
            customConfig: '../js/config.js'
        });
       
        CKEDITOR.replace('modifArtistFR', {
            customConfig: '../js/config.js'
        });
        CKEDITOR.replace('modifArtistEN', {
            customConfig: '../js/config.js'
        });
        CKEDITOR.replace('modifArtistNE', {
            customConfig: '../js/config.js'
        });
    });
    </script>
    </body>
</html>
