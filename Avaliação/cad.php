<?php 
require('classes.php');
$validador = new Login();
$validador->verificar_logado();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['name']) && !empty($_POST['curso'])){
        $conexao = new Cadastro();
        $cadastro = new Cadastro($conexao);
        $nome=($_POST['name']);
        $curso=($_POST['curso']);
        $curso_codigo = null;
        if($curso == "dsm"){
            $curso_codigo = 1;
        }
        elseif($curso == "ge"){
            $curso_codigo = 2;
        }
        else{
            echo "Curso Invalido";
        }

    }
    if ($cadastro->cadastrarCandidato($nome, $curso_codigo)) {
        echo "Candidato cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar candidato.";
    }
} else {
    echo "Por favor, preencha todos os campos do formulário.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    
<form method="post">
<label>Nome completo</label>
    <input type="text" name="name" placeholder="Name" require>
    <label>Curso</label>
    <select name="curso" required>
        <option value="ge">GE</option>
        <option value="dsm">DSM</option>
    </select>
    <button type="submit">Enviar</button>
</form>
<a href="home.php">Voltar</a>
</body>
</html>