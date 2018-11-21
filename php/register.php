<?php

include("dbConfig.php");

    //QUERY TO GET PREFERENCES
    $tags_query = "SELECT id_etiqueta, nombre_etiqueta FROM etiquetas";
    $tags_rs = $pdo->prepare($tags_query);
    $tags_rs->execute();

    /*$sec_per_tag_query = "SELECT e.id_etiqueta, e.nombre_etiqueta FROM etiquetas";
    $tags_sql = $pdo->prepare($tags_query);
    $sql->execute();*/

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/register.js"></script>
    <title>Regístrate</title>
</head>
<body>
    <div id ="loginForm">
        <header>Regístrate</header>
        <form id="theForm" action="registerUser.php" method="POST">
            <div class="imgContainer">

                <picture>

                <source srcset="../img/avatar.png" media="(min-width: 1280px)">
                <source srcset="../img/avatar.png" media="(min-width: 800px)">
                <source srcset="../img/avatar.png" media="(min-width: 400px)">

                <img src="../img/avatar.png">

                </picture>
            </div>
            <div class="userDataContainer">
                <label for="uname"><b>Usuario</b></label>
                <input type="text" placeholder="Usuario" name="uname" id="uname" >

                <label for="psw"><b>Contraseña</b></label>
                <input type="password" placeholder="********" name="psw" id="upass" >

                <label for="bday"><b>Fecha de nacimiento</b></label>
                <input type="date" name="bday" id="ubirthdate">
                
                <label for="gender"><b>Sexo</b></label>
                <label>Masculino</label>
                <input type="radio" name="gender" value="M" checked>
                <label>Femenino</label>
                <input type="radio" name="gender" value="F">

                <label for="email"><b>E-mail</b></label>
                <input type="text" placeholder="example@example.com" name="email" id="uemail" >

                <label><b>Preferencias</b></label>
                <?php 
                //ITERATE TAGS
                echo "<ul>";
                
                while($tags_r = $tags_rs->fetch(PDO::FETCH_OBJ)){
                    echo "<li><label>".$tags_r->nombre_etiqueta."</label><ul>";
                    //QUERY TO GET PREFERENCES
                    $sec_per_tag_query = "SELECT id_seccion, titulo FROM secciones WHERE id_etiqueta =".$tags_r->id_etiqueta;
                    $spt_rs = $pdo->prepare($sec_per_tag_query);
                    $spt_rs->execute();
                    while($spt_r = $spt_rs->fetch(PDO::FETCH_OBJ)){
                        echo "<li><label><input type='checkbox' id ='".$spt_r->id_seccion."' class='subOption'>".$spt_r->titulo."</label></li>";
                    }
                    echo "</ul></li>";    
                }
                echo "</ul>";   
                ?>

                <button class="registerBtn" type="submit" onclick="val()">Registrarse</button>
                <button class="cancelBtn" type="button" onclick="location.href='index.html'" >Cancelar</button>
            
            </div>
        </form>
    </div>
</body>

</html>