angular.module("indicador").controller("cadastroPessoaCtrl", function( $scope , $http, $location, $rootScope ){

  var foto = null;

  //EVENTO FORM 
  $scope.changeFoto = function(){
      foto = null;
      file = document.getElementById('foto').files[0],r = new FileReader();
      r.onloadend = function(file){
          foto = file.target.result;
      }
      if ( file != undefined ){
        if( (file != undefined) && (file["type"] != "image/jpeg") && (file["type"] != "image/png") && ((file["type"] != "application/jpg")) ){
          alert('O arquivo deve ser imagem (jpeg ou png).');
        }else{
          r.readAsDataURL(file);
        }
      }
  }

  // INSERE 
	$scope.cadastrar = function(form){
    var dados = { operacao : "inserir_pessoa", nome: form.nome, email: form.email, foto: foto };
    $http.post('ws/crudPessoa.php',dados,
      {
        headers : {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
      })
    .success(function(response, status, headers, config) {
        if(response.resultado == true){
          $('#nome').val('');
          $('#email').val('');
          $('#foto').val('');
          alert('Registro inserido com sucesso.');
          buscarPessoas();
        }else{
          console.log('Erro : '+response);
        }
      })
    .error(function(data, status, headers, config) {
      alert('Erro inserir_linha: '+data + ' - '+status);
    });  
  }

  // CARREGA 
  $scope.pessoas = [];
  function buscarPessoas(){
    $scope.pessoas = [];
    var dados = { operacao : "carregar_pessoas" };
    
        $http.post('ws/crudPessoa.php',dados,
          {
            headers : {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
          })
        .success(function(response, status, headers, config) {
            if(response.resultado != null){
              for( var i = 0 ; i < response.resultado.length ; i++){
                $scope.pessoas[i] = response.resultado[i];  
              }
            }
          })
        .error(function(data, status, headers, config) {
          alert('Erro: '+data + ' - '+status);
        });
  }
  buscarPessoas();

  // EXCLUI
  $scope.excluirPessoa = function(id){
  
    var dados = { operacao : "excluir_pessoa", id: id };
  
    $http.post('ws/crudPessoa.php',dados,
      {
        headers : {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
      })
    .success(function(response, status, headers, config) {
      if(response.resultado){
        alert('Registro excluido com sucesso.');
        buscarPessoas();
        }else{
          alert('Erro: '+response.resultado);
        }
      })
    .error(function(data, status, headers, config) {
      alert('Erro: '+data + ' - '+status);
    }); 

  }
	  
});