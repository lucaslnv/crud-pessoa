<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: appication/json; charset=UTF-8");

require_once ('../conexao.php');

$post = file_get_contents("php://input");

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$post = json_decode($post);


	//CARREGAR PROPAGANDAS
	if( $_POST['operacao'] == 'carregar_propagandas' ){

			$stmt = $conexao->stmt_init();
			$query = "select * from propaganda";
			$resultado = $conexao->query($query);

			if($resultado == false){
				echo '{ "resultado": "erro_sql", "sucesso": "false"}';	
			}

			$i = 0;
			while($data  = $resultado->fetch_assoc()){
				$dados[$i] = $data;
				$i++;
			}

			echo '{ "resultado": '. json_encode($dados) .' }'; 
		
	}

	//CARREGAR BAIRROS
	if( $_POST['operacao'] == 'carregar_bairros' ){

			$stmt = $conexao->stmt_init();
			$query = "select * from bairro order by nome";
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

	//CARREGAR CATEGORIAS
	if($_POST['operacao'] == 'carregar_categorias'){

			$stmt = $conexao->stmt_init();
			$query = "select * from categoria order by nome";
			$resultado = $conexao->query($query);

			if($resultado == false){
				echo '{ "resultado": false , "sucesso": "false"}';	
			}else{
				$i = 0;
				while($data  = $resultado->fetch_assoc()){
					$dados[$i] = $data;
					$i++;
				}
				echo '{ "resultado": '. json_encode($dados) .' }'; 
			}
	}

	//CARREGAR SERVICOS
	if($_POST['operacao'] == 'carregar_servicos'){

			$stmt = $conexao->stmt_init();
			$query = "select 
				servico.id, servico.empresa, bairro.nome as servicoBairro, bairro.id as servicoBairroId, categoria.nome as servicoCategoria, 
				categoria.id as servicoCategoriaId, servico.descricao, servico.contato, servico.endereco, servico.logo, categoria.sub_categoria as servicoSubCategoria, servico.foto1, servico.foto2, servico.foto3, servico.foto4, servico.foto5
				from servico 
				inner join bairro on servico.bairro = bairro.id 
				inner join categoria on servico.categoria = categoria.id 
				order by servico.empresa";
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

	//CARREGAR LINHAS
	if( $_POST['operacao'] == 'carregar_linhas' ){

			$stmt = $conexao->stmt_init();
			$query = "select * from linha";
			$resultado = $conexao->query($query);

			if($resultado == false){
				echo '{ "resultado": "erro_sql", "sucesso": "false"}';	
			}

			$i = 0;
			while($data  = $resultado->fetch_assoc()){
				$dados[$i] = $data;
				$i++;
			}

			echo '{ "resultado": '. json_encode($dados) .' }'; 
		
	}

	//CARREGAR PROPAGANDA ONIBUS
	if( $_POST['operacao'] == 'carregar_propaganda_onibus' ){

			$stmt = $conexao->stmt_init();
			$query = "select * from propaganda_onibus";
			$resultado = $conexao->query($query);

			if($resultado == false){
				echo '{ "resultado": "erro_sql", "sucesso": "false"}';	
			}

			$i = 0;
			while($data  = $resultado->fetch_assoc()){
				$dados[$i] = $data;
				$i++;
			}

			echo '{ "resultado": '. json_encode($dados) .' }'; 
		
	}

}else{
	echo "Erro na requisição.";
}