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
        <form id="regForm" action="registerUser.php" method="POST">
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

                <label for="upass"><b>Contraseña</b></label>
                <input type="password" placeholder="********" name="upass" id="upass" >

                <label for="ubirthdate"><b>Fecha de nacimiento</b></label>
                <input type="date" name="ubirthdate" id="ubirthdate">
                
                <label for="ugen"><b>Sexo</b></label>
                <label>Masculino</label>
                <input type="radio" name="ugen" value="M" checked>
                <label>Femenino</label>
                <input type="radio" name="ugen" value="F">

                <label for="uemail"><b>E-mail</b></label>
                <input type="text" placeholder="example@example.com" name="uemail" id="uemail" >

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
                        echo "<li><label><input type='checkbox' class = 'sec_ids' id ='".$spt_r->id_seccion."' value ='".$spt_r->id_seccion."' name = 'sec_ids[]' class='subOption'>".$spt_r->titulo."</label></li>";
                    }
                    echo "</ul></li>";    
                }
                echo "</ul>";   
                ?>

                <button class="registerBtn" type="submit" >Registrarse</button>
                <button class="cancelBtn" type="button" onclick="location.href='index.html'" >Cancelar</button>
            
            </div>
        </form>
    </div>
</body>

</html>