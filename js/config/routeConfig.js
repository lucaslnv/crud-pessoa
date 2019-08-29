angular.module("indicador").config(function( $routeProvider ){

	$routeProvider.when("/masterPage",{
		templateUrl: "view/masterPage.html"
	});

	$routeProvider.when("/cadastroPessoa",{
		templateUrl: "view/cadastroPessoa.html",
		controller: "cadastroPessoaCtrl"
	});

	$routeProvider.otherwise({redirectTo:"/masterPage"});

});