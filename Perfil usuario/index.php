
<?php
require 'config.php';
session_start();
$_SESSION["id"] = 1;
$sessionId = $_SESSION["id"];
$userQuery = "SELECT * FROM tb_user WHERE id = $sessionId";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

$skillsQuery = "SELECT * FROM usuarios WHERE user_id = $sessionId";
$skillsResult = mysqli_query($conn, $skillsQuery);
$skills = mysqli_fetch_all($skillsResult, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="perfilstyle.css">
</head>
<body>
    <div class="profile-container">
        <header class="profile-header">
            <div class="upload">
                <img src="img/<?php echo htmlspecialchars($user['image']); ?>" id="image" class="profile-pic">
                <div class="rightRound" id="upload">
                    <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                    <i class="fa fa-camera"></i>
                </div>
                <div class="leftRound" id="cancel" style="display: none;">
                    <i class="fa fa-times"></i>
                </div>
                <div class="rightRound" id="confirm" style="display: none;">
                    <input type="submit" form="imageForm">
                    <i class="fa fa-check"></i>
                </div>
            </div>
        </header>
        <div class="profile-content">
            <div class="left-column">
                <div class="field">
                    <button class="settings-btn">Alterar</button>
                    <h2>Sobre você</h2>
                    <input type="text" value="Campo de informação do usuário. Aqui você pode adicionar algumas informações sobre o usuário, seus interesses, hobbies, etc." disabled>
                  <button class="edit-button" onclick="editListItem(this.parentElement)">Editar</button>
                 <button class="save-button" onclick="saveListItem(this.parentElement)" style="display:none;">Salvar</button>
                </div>
            </div>
            <div class="right-column">
                <div class="field">
                    <h2>Informações Pessoais</h2>
                    <ul>
                        <li><strong>Nome:</strong>  <?php echo htmlspecialchars($user['nome']); ?></li>
                        <br>
                        <li><strong>Email:</strong> usuario@example.com</li>
                    
                        <br>
                        <li>
                            <strong>Telefone:</strong>
                            <input type="tel" id="phone" value="(00) 12345-6789" disabled>
                            <button class="edit-button" onclick="editField(this.parentElement)">Editar</button>
                            <button class="save-button" onclick="saveField(this.parentElement)" style="display:none;">Salvar</button>
                        </li>
                      
                        <li>
                            <strong>Endereço:</strong>
                            <input type="text" id="address" value="Rua Exemplo, 123, Cidade, País" disabled>
                            <button class="edit-button" onclick="editField(this.parentElement)">Editar</button>
                            <button class="save-button" onclick="saveField(this.parentElement)" style="display:none;">Salvar</button>
                        </li>
                  
                    </ul>
                </div>
            </div>
            <div class="right-column">
                <div class="field">
                    <h2>Profissão</h2>
                    <div class="content">
                        <ul id="editable-list">
                            <li>
                                <strong>Experiências:</strong>
                                <input type="text" value="Experiências" disabled>
                                <button class="edit-button" onclick="editListItem(this.parentElement)">Editar</button>
                                <button class="save-button" onclick="saveListItem(this.parentElement)" style="display:none;">Salvar</button>
                            </li>
                            <br>
                            <li>
                                <strong>Empresas:</strong>
                                <input type="text" value="Empresas" disabled>
                                <button class="edit-button" onclick="editListItem(this.parentElement)">Editar</button>
                                <button class="save-button" onclick="saveListItem(this.parentElement)" style="display:none;">Salvar</button>
                            </li>
                            <br>
                            <li>
                                <strong>Solicitantes:</strong>
                                <input type="text" value="Solicitantes" disabled>
                                <button class="edit-button" onclick="editListItem(this.parentElement)">Editar</button>
                                <button class="save-button" onclick="saveListItem(this.parentElement)" style="display:none;">Salvar</button>
                            </li>
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="imageForm" action="" method="post" enctype="multipart/form-data" style="display: none;">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
    </form>

    <script type="text/javascript">
        document.getElementById("fileImg").onchange = function() {
            document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
            document.getElementById("cancel").style.display = "block";
            document.getElementById("confirm").style.display = "block";
            document.getElementById("upload").style.display = "none";
        }

        var userImage = document.getElementById('image').src;
        document.getElementById("cancel").onclick = function() {
            document.getElementById("image").src = userImage; // Back to previous image
            document.getElementById("cancel").style.display = "none";
            document.getElementById("confirm").style.display = "none";
            document.getElementById("upload").style.display = "block";
        }

        function editListItem(item) {
            var input = item.querySelector('input');
            input.removeAttribute('disabled');
            var editButton = item.querySelector('.edit-button');
            var saveButton = item.querySelector('.save-button');
            editButton.style.display = 'none';
            saveButton.style.display = 'inline-block';
        }

        function saveListItem(item) {
            var input = item.querySelector('input');
            input.setAttribute('disabled', 'disabled');
            var editButton = item.querySelector('.edit-button');
            var saveButton = item.querySelector('.save-button');
            editButton.style.display = 'inline-block';
            saveButton.style.display = 'none';
        }

        function editField(item) {
            var input = item.querySelector('input');
            input.removeAttribute('disabled');
            var editButton = item.querySelector('.edit-button');
            var saveButton = item.querySelector('.save-button');
            editButton.style.display = 'none';
            saveButton.style.display = 'inline-block';
        }

        function saveField(item) {
            var input = item.querySelector('input');
            input.setAttribute('disabled', 'disabled');
            var editButton = item.querySelector('.edit-button');
            var saveButton = item.querySelector('.save-button');
            editButton.style.display = 'inline-block';
            saveButton.style.display = 'none';
        }
    </script>

    <?php
    if (isset($_FILES["fileImg"]["name"])) {
        $id = $_POST["id"];
        $src = $_FILES["fileImg"]["tmp_name"];
        $imageName = uniqid() . '_' . $_FILES["fileImg"]["name"];
        $target = "img/" . $imageName;

        if (move_uploaded_file($src, $target)) {
            $query = $conn->prepare("UPDATE tb_user SET image = ? WHERE id = ?");
            $query->bind_param("si", $imageName, $id);
            if ($query->execute()) {
                echo "<script>alert('Imagem de perfil atualizada com sucesso!');</script>";
                header("Location: index.php");
            } else {
                echo "<script>alert('Erro ao atualizar a imagem de perfil no banco de dados.');</script>";
            }
        } else {
            echo "<script>alert('Erro ao mover a imagem para a pasta img.');</script>";
        }
    }
    ?>
</body>
</html>
