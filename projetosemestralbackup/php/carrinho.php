<?php
// Crie uma nova conexão
$conn = mysqli_connect("localhost:3306", "root", "", "loja");

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receba os dados do POST
$idProduto = $_POST['id_produto'];
$idUsuario = $_POST['id_usuario'];
$quantidade = $_POST['quantidade'];
$statusComprado = 0; // Supondo que o status inicial seja 0 (não comprado)

// Verifique se o item já está no carrinho
$sql = "SELECT id_carrinho, quantidade FROM carrinho WHERE id_usuario = '$idUsuario' AND id_produto = '$idProduto' AND statuscomprado = $statusComprado";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // O item já está no carrinho, então aumente a quantidade
    $row = $result->fetch_assoc();
    $idCarrinho = $row['id_carrinho'];
    $novaQuantidade = $row['quantidade'] + $quantidade;
    
    // Atualize a quantidade no carrinho
    $sql = "UPDATE carrinho SET quantidade = '$novaQuantidade' WHERE id_carrinho = '$idCarrinho'";
    if ($conn->query($sql) === TRUE) {
        echo "Quantidade atualizada com sucesso + $sql";
    } else {
        echo "Erro ao atualizar a quantidade: " . $conn->error;
    }
} else {
    // O item não está no carrinho, então insira-o
    $sql = "INSERT INTO carrinho (id_usuario, id_produto, statuscomprado, quantidade) VALUES ('$idUsuario', '$idProduto',$statusComprado, '$quantidade')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Item adicionado com sucesso + $sql";
    } else {
        echo "Erro ao inserir o item: " . $conn->error;
    }
}

// Feche a conexão com o banco de dados
$conn->close();
?>
