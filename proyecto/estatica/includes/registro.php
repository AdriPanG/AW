<?php
	include ("config.php");
	include ('usuario.php');
	$user=$_POST['usuario'];
	$pass=$_POST['contraseña'];
	$nombre=$_POST['nombre'];
	$app=$_POST['apellidos'];
	$dni=$_POST['dni'];
	$email=$_POST['email'];
	$fecha=$_POST['fecha'];
	$sexo=$_POST['sexo'];
	$tlf=$_POST['tlf'];
	$cp=$_POST['cp'];
	$direccion=$_POST['direccion'];
	$avatar='';

	$sql = "SELECT * FROM usuario";
	$sql = mysqli_query($connection, $sql); 
    $verificar_usuario = 0;//Creamos la variable $verificar_usuario que empieza con el valor 0 y si la condición que verifica el usuario(abajo), entonces la variable toma el valor de 1 que quiere decir que ya existe ese nombre de usuario por lo tanto no se puede registrar
  	
	while($result = mysqli_fetch_object($sql)) { 
	    if($result->usuario == $_POST['usuario'] or $result->email == $_POST['email']){  //Esta condición verifica si ya existe el usuario 
	        $verificar_usuario = 1; 
	    } 
	} 
	  
	if($verificar_usuario == 0) { 
	    $nuevo_user = new Usuario($nombre,$dni,$app,$direccion,$cp,$user,MD5($pass),$email,$fecha,$avatar,$sexo,$tlf);
	    if($nuevo_user->validar_dni($dni)){
			$nuevo_user->addUser($connection);
			header("Location: ../index.php"); //Se ha registrado correctamente
	     }
	     else{
			header("Location: ../registrate.php");  //Error en el dni
	     }
	}else{ 
	    echo 'Este usuario ya ha sido registrado anteriormente.';
	    header("Location: ../registrate.php"); 
	} 
?> 
