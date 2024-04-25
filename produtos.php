<?php
// Informações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'sistema';
$username = 'root';
$password = '';

// Criar conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Selecionar todos os produtos da tabela produtos
$sql = "SELECT nome, descricao, preco, foto FROM produtos";
$result = $conn->query($sql);

// Exibir os produtos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['nome'] . "</h2>";
        echo "<p><strong>Descrição:</strong> " . $row['descricao'] . "</p>";
        echo "<p><strong>Preço:</strong> R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
        echo '<img src="uploads/' . $row['foto'] . '" alt="' . $row['nome'] . '" width="200"><br><br>';
    }
} else {
    echo "Nenhum produto cadastrado.";
}

// Fechar conexão
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 5px;
        }
        p {
            color: #666;
            margin-top: 0;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-editar {
            background-color: #28a745;
        }
        .btn-excluir {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $host = 'localhost';
        $dbname = 'sistema';
        $username = 'root';
        $password = '';

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $sql = "SELECT nome, descricao, preco, foto FROM produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<h2>" . $row['nome'] . "</h2>";
                echo "<p><strong>Descrição:</strong> " . $row['descricao'] . "</p>";
                echo "<p><strong>Preço:</strong> R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
                echo '<img src="uploads/' . $row['foto'] . '" alt="' . $row['nome'] . '"><br><br>';
                echo '<div class="btn-container">';
                echo '<a href="editar_produto.php?id=' . $row['id'] . '" class="btn btn-editar">Editar</a>';
                echo '<a href="excluir_produto.php?id=' . $row['id'] . '" class="btn btn-excluir">Excluir</a>';
                echo '</div>';
            }
        } else {
            echo "Nenhum produto cadastrado.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>