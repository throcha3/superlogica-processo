<?php 
    require_once('models/Pessoa.class.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>SUPERLÓGICA</title>
  <style> 
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
  </style>
</head>
<body>

<table >
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome completo</th>
            <th>Nome Login</th>
            <th>CEP</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <?php
                  $pessoas = new Pessoa;
                  
                  $pessoas = $pessoas->select();
                  //var_dump($_SESSION['userid']);
                  if (true){
                    while($aux = mysqli_fetch_array($pessoas)){
                        echo '<tr>';
                            echo '<td>' .$aux['id'].' </td>';
                            echo '<td>' .$aux['nome'].' </td>';
                            echo '<td>' .$aux['login'].' </td>';
                            echo '<td>' .$aux['cep'].' </td>';
                            echo '<td>' .$aux['email'].' </td>';
                        echo '</tr>';
                      }
                  }
                  

              ?>
        </tr>
    </tbody>
</table>

<h3> Novo cadastro </h3>
<br />
<form method="post" action="controllers/PessoaController.php">
    <div>
        <label for="name">Nome completo:</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="userName">Nome de login:</label>
        <input type="text" id="userName" name="userName">
    </div>
    <div>
        <label for="zipCode">CEP</label>
        <input type="text" id="zipCode" name="zipCode">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
    </div>
    <div>
        <label for="password">Senha (8 caracteres mínimo, contendo pelo menos 1 letra e 1 número):</label>
        <input type="password" id="password" name="password">
    </div>
    <input type="hidden" name="method" value="inserir">
    <input type="submit" value="Cadastrar">
</form>

</body>
</html>