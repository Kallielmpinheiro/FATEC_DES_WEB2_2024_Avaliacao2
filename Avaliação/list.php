<?php
include_once 'classes.php';
$validador = new Login();
$validador->verificar_logado();
// if(!$validador->verificar_logado()){
//     header("Location: login.php");
//     exit();
// }
    $conexao = new Cadastro();
    $visualizar = new Cadastro($conexao); 
    $candidatos = $visualizar->lerCandidatos();
    if (!empty($candidatos)) {
        foreach ($candidatos as $candidato) {
            $curso = "";
            if ($candidato['curso'] == 2) {
                $curso = "Dms";
            } else {
                $curso = "Ge";
            }
            echo "O candidato com o nome: " . $candidato['nome'] . " escolheu o curso - Curso: " . $curso . "<br>";
        }
    } else {
        echo "Nenhum candidato cadastrado.";
    }
    
?>
<html>
    <a href="home.php">Voltar</a>
</html>
