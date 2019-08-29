<?php

header("Access-Control-Allow-Origin: *");
require_once ('conexao.php');

$post = file_get_contents("php://input");

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$post = json_decode($post);

	//INSERIR
	if($post->operacao == 'inserir_pessoa'){
		if( ! empty($post->nome) ){
			$nome = $post->nome;
			$email = $post->email;
			$foto = $post->foto;
			$stmt = $conexao->stmt_init();
			$query = "insert into pessoa (nome, email, foto) values('$nome', '$email', '$foto') ";
			$resultado = $conexao->query($query); 

			if($resultado == false){
				echo '{ "resultado": "erro_sql", "sucesso": "false"}';	
			}

			echo '{ "resultado": '. json_encode($resultado) .' }'; 
		}else{
			echo '{ "resultado": "nome_vazio" }'; 
		}
	}

	//CARREGAR 
	if( $post->operacao == 'carregar_pessoas' ){

			$stmt = $conexao->stmt_init();
			$query = "select * from pessoa order by nome";
			$resultado = $conexao->query($query);
			
			if($resultado == false){
				echo '{ "resultado": false, "sucesso": "false"}';	
			}else{
				$i = 0;
				while($data  = $resultado->fetch_assoc()){
					$dados[$i] = $data;
					$i++;
				}
				echo '{ "resultado": '. json_encode($dados) .' }'; 
			}
	}
	
	//EXCLUIR 
	if($post->operacao == 'excluir_pessoa'){

		if( ! empty($post->id) ){
			$id = $post->id;
			$stmt = $conexao->stmt_init();
			$query = "delete from pessoa where id = '$id' ";
			$resultado = $conexao->query($query); 

			if($resultado == false){
				echo '{ "resultado": "erro_sql", "sucesso": "false"}';	
			}

			echo '{ "resultado": '. json_encode($resultado) .' }'; 
		}else{
			echo '{ "resultado": "Id nao encontrado" }'; 
		}
	}


}else{
	echo "Erro na requisição.";
}