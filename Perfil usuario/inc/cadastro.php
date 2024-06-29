<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $datanascimento = $_POST['datanascimento'];
    $cidade = $_POST['cidade'];
    $senha = $_POST['senha'];
    $check_senha = $_POST['check_senha']; // Ajustado para 'check_senha'

    // Verifica se as senhas coincidem
    if ($senha != $check_senha) {
        die("As senhas não coincidem.");
    }

    // Configurações do banco de dados
    $host = 'localhost';
    $banco = 'extrawork-formulario';
    $senha_user = ''; // Senha do MySQL
    $user = 'root'; // Nome do usuário do MySQL

    // Conecta-se ao banco de dados
    $con = mysqli_connect($host, $user, $senha_user, $banco);

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$con) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Prepara a consulta SQL para inserir os dados no banco de dados
    $stmt = $con->prepare("INSERT INTO usuarios (nome, email, telefone, genero, datanascimento, cidade, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nome, $email, $telefone, $genero, $datanascimento, $cidade, $senha);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Cadastrado com sucesso.";
        $stmt->close();
        mysqli_close($con);
        header("Location: ../login.html");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
        $stmt->close();
        mysqli_close($con);
        header("Location: ../formulario.html");
        exit();
    }

    // Fecha a conexão com o banco de dados (este código é inalcançável)
    // $stmt->close();
    // mysqli_close($con);
}

