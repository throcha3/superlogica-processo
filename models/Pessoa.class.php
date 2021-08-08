<?php 
require_once('Banco.class.php');
class Pessoa 
{
	public $tabela = "pessoa";

	public $colunas = [
		'id',
		'nome',
		'login',
		'email',
		'senha',
		'cep',		
	];

	/**
	* @param array valores é um array com os nomes e valores da tabela Pessoa
	*/
	function validacao($valores)
	{
		//Variavel que vai imprimir os erros na tela caso haja alguma ocorrencia
		$erros = "";
		//Se o nome é completo deve haver pelo menos um espaço.
		//str_contains só funciona no php 8
		if (!str_contains($valores['nome']," "))  $erros .= " <br /> Favor digitar seu nome commpleto";
		//Tamanho minimo e maximo no nome
		if (mb_strlen($valores['nome']) < 3 || mb_strlen($valores['nome']) > 50  ) $erros .= " <br /> Tamanho do nome incorreto";
		//Validação da senha 
		$pattern ="^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]{8,30}$^";
		if (!preg_match($pattern, $valores['senha'])) $erros .= " <br /> A senha deve ter pelo menos 8 digitos e menos que 30, uma letra e um número";
		//CEP tem 8 digitos mas pode haver o -
		if (mb_strlen($valores['cep']) < 8 || mb_strlen($valores['cep']) > 9) $erros .= " <br /> CEP incorreto";
		//Não pode haver espaço no login
		//str_contains só funciona no php 8
		if (str_contains($valores['login']," ")) $erros .= "<br /> O login deve conter apenas 1 palavra";
		
		return $erros;
	}
	/**
	* @param array valores é um array com os nomes e valores da tabela Pessoa
	*/
	function inserir($valores=NULL)
	{
		$tabela = addslashes($this->tabela);
		$colunas = "`".implode("`,`", $this->colunas)."`";
		$valores = implode(",", $valores);
		$con = Banco::conectar();
		$queryInsert = ("INSERT INTO $tabela ($colunas) VALUES ($valores) ;");
		$resultInsert = mysqli_query($con,$queryInsert);
		echo $queryInsert;
		mysqli_close($con);
		if ($resultInsert) {
			return 'Success';
		} else {
			return 'Fail'; //$queryInsert;
		}
	}
	/**
	* @param string tabela é o nome da tabela que será executado a query, neste caso já esta definida na classe
	* @param string where é o campo e valor a ser pesquisado, já no formato sql
	*/
	function select($tabela=NULL,$where=NULL) 
	{
		$tabela = $this->tabela;
		$where   = !empty($where)  ? " WHERE "   . $where   : NULL;

		$con     = Banco::conectar();

		$querySelect = ('SELECT * FROM '.addslashes($tabela).$where.' ;');
		
		$querySelect = mysqli_query($con,$querySelect);
		mysqli_close($con);
 		return $querySelect;
	}

	/**
	* @param array valores é um array com os nomes e valores da tabela Pessoa
	* @return string com os valores da array valores no formato sql
	*/
	public function trataArrayValores($valores)
	{
		foreach ($valores as $key => $k) {
				if(is_string($k) && !is_null($k)){
					$k = "'" . $k . "'";
					$valores[$key] = $k;
				}
				else if(is_null($k)){
					$valores[$key] = "NULL";
				}
			}
		return $valores;
	}


}