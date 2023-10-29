<?php
// Crie uma nova conexão
$conn = mysqli_connect("localhost:3306", "root", "", "loja");

// Verifique a conexão
if (mysqli_connect_error()) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Consulta SQL para obter os itens do carrinho do usuário (id_usuario = 1)
$idUsuario = 1;
$statusComprado = 0; // Itens no carrinho têm status 0 (não comprados)

$sql = "SELECT carrinho.id_carrinho ,produto.nome, carrinho.quantidade
        FROM carrinho
        INNER JOIN produto ON carrinho.id_produto = produto.id_produto
        WHERE carrinho.id_usuario = $idUsuario AND carrinho.statuscomprado = $statusComprado";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dados = array();
    while($registro = mysqli_fetch_assoc($result)) {
        array_push($dados, $registro);
    }

    // Retorne os itens do carrinho em formato JSON
    $json = json_encode($dados);
    echo $json;
} else {
    // Carrinho vazio
    echo "[]";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
