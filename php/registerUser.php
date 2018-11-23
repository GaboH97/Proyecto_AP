<?php 
	
    include("dbConfig.php");

	try {

    //foreach($mbd->query('SELECT * from prueba') as $fila) {
    //    print_r($fila);
	
	$uname = $_POST["uname"];
	$upass = $_POST["upass"];
    $ubday = $_POST["ubirthdate"];
    $ugen  = $_POST["ugen"];
    $uemail = $_POST["uemail"];
    
    //ARREGLAR, AQUÍ DEBERÍA OBTENER EL ARRAY CON LOS ÍNDICES DE LAS SECCIONES DE PREFERENCIA

    $pref = $_POST["sec_ids"];

    //QUERY TO KNOW IF USER ALREADY EXISTS
	$sql_query = "SELECT * FROM users WHERE user_name = ? OR email = ?";
    $sql = $pdo->prepare($sql_query);
    $sql->execute([$uname,$upass]);
    $affected = $sql->rowCount();

     if($result3 = $sql->fetch(PDO::FETCH_OBJ)){
        //session_start();
       
        echo "<span>Usuario ya existe </span> <p><a href=\"register.php\"> Volver<p>";
    
        //header("Status: 301 Moved Permanently");
        //exit;
    }
    else{
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_query = "INSERT INTO users (user_name,password,birthdate,genre,email) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql_query);
        $stmt->execute(array($uname,$upass,$ubday,$ugen,$uemail));

        //REGISTRA LAS PREFERENCIAS DEL USUARIO DEFINIDAS EN EL FORMULARIO DE REGISTRO

        $pref_arr = explode (",", $pref);

        foreach ($pref_arr as $id_sec){
            $user_pref_query ="INSERT INTO preferencias(user_name,id_seccion,seleccionado) VALUES (?,?,?)";
            $user_pref_rs = $pdo->prepare($user_pref_query);
            $user_pref_rs->execute([$uname,$id_sec,'S']);
        }

        echo "OK";
         //header("location: ../index.html");
    }
    
    
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>