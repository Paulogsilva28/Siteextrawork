<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Configurações do banco de dados
    $host = 'localhost'; // Host do MySQL (geralmente 'localhost')
    $banco = 'extrawork-formulario'; // Nome do banco de dados
    $senha_user = ''; // Senha do MySQL
    $user = 'root'; // Nome de usuário do MySQL

    // Conecta-se ao banco de dados
    $conn = new mysqli($host, $user, $senha_user, $banco);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para verificar os dados no banco de dados
    $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se existe o usuário ou os dados estão corretos
    if ($result->num_rows > 0) {
        // Iniciar sessão no browser
        session_start();
        
        // Obter os dados do usuário
        $row = $result->fetch_assoc();
        
        // Armazenar dados do usuário na sessão
        $_SESSION['nome'] = $row['nome'];
        
        // Fecha a declaração e a conexão
        $stmt->close();
        $conn->close();
        
        // Redirecionar para a página do painel
        header("Location: ../telainicial.html");
        exit();
    } else {
        // Fecha a declaração e a conexão
        $stmt->close();
        $conn->close();
        
        // Se as credenciais estiverem erradas, redireciona de volta para a página de login com uma mensagem de erro;
        header("Location: ../login.html");
        exit();
    }
}

