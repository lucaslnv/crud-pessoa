<?php

	$server = "localhost";
	$user = "root";
	$pass = "root";
	$database = "bd";
	
	//Conexao
	@$conexao = new mysqli($server,$user,$pass,$database);
	
	//Error
	if(mysqli_connect_errno()){
		echo "Falha na conexao: ".$conexao->connect_errno. " ".$conexao->connect_error;
		exit;
	}

?>
