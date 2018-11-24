<?php 
	
    include("dbConfig.php");
    
	//DB connection settings

	//$dbuser = "root";
	//$dbpass = "Theothershore97";
	//$dbhost = "localhost";
	//$dbname = "users";


	try {
    //$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    //foreach($mbd->query('SELECT * from prueba') as $fila) {
    //    print_r($fila);
	

	$uname = $_POST["uname"];
	$upass = $_POST["psw"];


	$sql_query = "SELECT * FROM users WHERE user_name = ? AND password = ?";
    $sql = $pdo->prepare($sql_query);
    $sql->execute([$uname,$upass]);
    $affected = $sql->rowCount();

     if($result3 = $sql->fetch(PDO::FETCH_OBJ)){
        session_start();
        $_SESSION['uname'] = $uname;
        $_SESSION['logged'] = true;
        !$_SESSION['loaded'] = false;
        echo "este es el nombre ".$_SESSION['uname'];
        echo "<p>";
        print $result3->user_name."\n";
        print $result3->password."\n";
        print("\n");
        echo "</p>";
        echo "<span>Usuario encontrado</span>";
    
        //header("Status: 301 Moved Permanently");
        header("Location: main_page.php");
        //exit;
    }
    else{
       // header("Location: ../index.html");
        echo "Usuario no encontrado";
    }
    
    
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>