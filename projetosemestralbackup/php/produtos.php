<?php
  $con = mysqli_connect("localhost:3306", "root", "", "loja");

    $resultado = mysqli_query($con, "SELECT * FROM produto");

    $dados = array();

    while($registro = mysqli_fetch_assoc($resultado)) {

    array_push($dados, $registro);

    }

    $json = json_encode($dados);
    echo $json;
?>
