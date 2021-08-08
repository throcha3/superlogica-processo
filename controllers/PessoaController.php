<?php

require_once('../models/Pessoa.class.php');

$telaRedirect = "../index.php";


class PessoaController
{
	public function inserir()
	{
		$pessoa = new Pessoa;
		$valores = array();

		$nome   = !empty($_POST['name'])  ? $_POST['name']   : NULL;
		$email  = !empty($_POST['email']) ? $_POST['email']  : NULL;
		$senha  = !empty($_POST['password']) ? $_POST['password']  : NULL;
		$login  = !empty($_POST['userName']) ? $_POST['userName']  : NULL;
		$cep    = !empty($_POST['zipCode'])   ? $_POST['zipCode']    : NULL;

    	$valores =array( 
			"id" => 0,
			"nome" =>  $nome,
			"login" => $login,
			"email" =>  $email,
			"senha" => $senha,
			"cep" =>  $cep
		);
		//Validação dos valores dos campos
		$validacao = $pessoa->validacao($valores);

		if ($validacao <> "") {
			echo "Erro ao cadastrar.  <a href='../index.php'> Clique aqui para retornar</a>".$validacao;
		}
		//Transforma a senha em md5
		$valores["senha"] = md5($senha);
		$valores = $pessoa->trataArrayValores($valores);

    	$x = $pessoa->inserir($valores);

		if($x == "Success"){
			header('Location:../'.$this->telaRedirect);
		}
		else {
			echo "Erro ao cadastrar.  <a href='../index.php'> Clique aqui para retornar</a>";
			//header('Refresh: 10; URL='.$this->telaRedirect);
		}
    

	}

}

// Controle de tipo de requisição e qual método será executado
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])) { 
	$method = $_POST['method'];
	if(method_exists('PessoaController', $method)) {
		$pessoa = new PessoaController;
		$pessoa->$method();
	}
	else {
		echo 'Metodo incorreto';
	}
}

