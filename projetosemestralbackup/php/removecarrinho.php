<?php
// Crie uma nova conexão
$conn = mysqli_connect("localhost:3306", "root", "", "loja");

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receba o ID do carrinho a ser removido do POST ou de outra fonte
$idCarrinho = $_POST['id_carrinho'];

// Verifique se o carrinho existe antes de tentar removê-lo
$sql = "SELECT id_carrinho FROM carrinho WHERE id_carrinho = '$idCarrinho'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // O carrinho existe, então você pode removê-lo
    $sql = "DELETE FROM carrinho WHERE id_carrinho = '$idCarrinho'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Item removido do carrinho com sucesso";
    } else {
        echo "Erro ao remover o item do carrinho: " . $conn->error;
    }
} else {
    echo "Carrinho não encontrado";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
