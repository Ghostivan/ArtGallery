 <!--<!DOCTYPE html>

    Created on : 2 avr. 2015, 20:25:41
    Author     : Navi
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title>Thea's Art Gallery</title>
    </head>
    <body class="metro" onload="calcul()">-->
<?php include("../rel/header.php"); ?>
        <h1>Bienvenue sur l'administration</h1>
        <br />
        <form name="auth_form" method="POST" onsubmit="return validateForm()" action="home.php">
            <div class="input-control text">
                <input name="pseu" type="text" placeholder="Pseudo" />
            </div>
            <div class="input-control password" data-role="input">
                <input name="pass" type="password" placeholder="Password Admin" />
            </div><br />
            
            <span id="quest"></span><br /><br />
            <input id="answer" name="answer" type="text" placeholder="Réponse" /><br />
            <input id="secu" type="hidden" value="" /><br />
            <input type="submit" value="Connexion" />
        </form>
        <!--<form name="auth_form" method="POST" onsubmit="return validateForm()" action="home.php">
            <input name="pseu" type="text" placeholder="Pseudo Admin" /><br /><br />
            <input name="pass" type="password" placeholder="Password Admin" /><br /><br />
            <b> Pour des raisons de sécurité, prouver que vous êtes un humain, en donnant le résultat de A + B + C: <b><br /><br />
            <span id="quest"></span><br />
            <input id="answer" name="answer" type="text" placeholder="Réponse" /><br />
            <input id="secu" type="hidden" value="" /><br />
            <input type="submit" value="Connexion" />
        </form> -->
        <script>
            calcul();
            function validateForm() {
                var x = document.forms["auth_form"]["pseu"].value;
                var y = document.forms["auth_form"]["pass"].value;
                var z = document.forms["auth_form"]["answer"].value;
                treatment(x);
                treatment(y);
                verify(z);
            }
            function treatment(i){
                if (i == null || i == "") {
                    alert("Saisie Incorrecte");
                    document.getElementById("pseu").value = "Erreur";
                    document.getElementById("pass").value = "";
                    return false;
                }
            }
            function verify(i){
                 if(i != document.getElementById("secu").value){
                    alert("Erreur sur la réponse de a + b + c");
                    document.getElementById("answer").value = null;
                    return false;
                }
            }
            function calcul(){
                var a = Math.floor((Math.random() * 26) + 1);
                var b = Math.floor((Math.random() * 17) + 1);
                var c = Math.floor((Math.random() * 20) + 1);
                document.getElementById("quest").innerHTML = "A = "+a+"<br />B = "+b+"<br />C = "+c+" "; 
                document.getElementById("secu").value = a+b+c;
            }
        </script>
<?php include("../rel/footer.php"); ?>