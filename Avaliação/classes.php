<?php 
session_start();
class Login { 
    private $name = 'vestibular'; 
    private $password = 'fatec'; 
    
    public function verificar_credenciais($name, $password) { 
        if ($name == $this->name && $password == $this->password) {
            $_SESSION["logged_in"] = TRUE;
            return TRUE;
        }
        return FALSE;
    } 

    public function verificar_logado() { 
        if ($_SESSION["logged_in"]) {
            return TRUE;
        }
        $this->logout();
    } 

    public function logout() { 
        session_destroy();
        header("Location: index.php");
        exit();
    } 
} 

class Cadastro {
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=localhost;dbname=banco1", "root", "");
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            exit();
        }
    }

    public function cadastrarCandidato($nome, $curso) {
        try {
            $stmt = $this->conexao->prepare("INSERT INTO candidatos (nome, curso) VALUES (:nome, :curso)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':curso', $curso);
            $stmt->execute();
            return true; 
        } catch(PDOException $e) {
            echo "Erro ao cadastrar candidato: " . $e->getMessage();
            return false; 
        }
    }

    public function lerCandidatos() {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM candidatos");
            $stmt->execute();
            $candidatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $candidatos; 
        } catch(PDOException $e) {
            echo "Erro ao ler candidatos: " . $e->getMessage();
            return array(); 
        }
    }
}


?>
