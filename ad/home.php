
<?php
session_start();
if($_GET){
    // Destruction de la session Administrateur
    if($_GET['logout']==1){
        session_destroy();
        header('Location: home.php');
    }
}
if (!isset($_SESSION['admin'])){
    // Vérification MDP et Login en BDD
    if ($_POST) {
        if(($_POST["pseu"] != null && $_POST["pass"] != null && $_POST["answer"] != null ) || ($_POST["pseu"] != "" && $_POST["pass"] != "" && $_POST["answer"] != "")){
            include("data/model.php");
            if(verifAdmin($_POST["pseu"],sha1($_POST["pass"]))){
                $_SESSION['admin'] = $_POST["pseu"];
                header('Location: home.php');
            }else{
                $_POST["admin"] = null;
            }
        }
    }
    include("data/security/security.php");
    }else{
        include("../rel/header.php");
        echo("<h1>Hello ".$_SESSION['admin']."</h1>");
        include("data/model.php");
        include("data/security/adminArtist.php");
    ?>
    <script>
        $(document).ready(function(){
            $(".navigation-bar-content").append("<a class='element brand place-right' href='?logout=1'>Déconnexion</a>");
        });
    </script>

     <?php
       include("../rel/footer.php");
    }
?>