<?php

class Banco
{
	public function conectar()
	{
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$dbname = "superlogica";

		$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

		if ($con->connect_errno) 
		{
			return ("Falha na conexão: %s\n". $con->connect_error);
			exit();	
		} 
		 else 
		{
			return  $con;
		}
	}
	
}

?>
