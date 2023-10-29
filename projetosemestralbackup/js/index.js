window.onload = async () => {
  var resultado = await fetch("php/produtos.php", {
    method: "GET",
  });

  var dados = await resultado.json();

  for (var i = 0; i < dados.length; i++) {
    var conteudo = `
    <div class="card">
      <div class="card-imagem">
        <img src="${dados[i].imagem}"/>
      </div>
      <div class="card-nome">${dados[i].nome}</div>
      <div class="card-preco">R$ ${dados[i].preco}</div>
      <div class="card-botao">
      <button class="botao-comprar" type="button" onclick="adicionarAoCarrinho(${dados[i].id_produto})">Adicionar ao Carrinho </button>
      </div>
    </div>
  `;
    document.getElementById("produtos").innerHTML += conteudo;
  }
};

function adicionarAoCarrinho(idProduto) {
  var dados = new FormData();

  dados.append("id_produto", idProduto);
  dados.append("id_usuario", 1);
  dados.append("quantidade", 1);
  dados.append("id_usuario", 1);

  fetch("php/carrinho.php", {
    method: "POST",
    body: dados,
  });
}

function barraDePesquisa() {
  let input = document.getElementById("buscar").value.toLowerCase(); // Obtém o valor de pesquisa em minúsculas
  let cards = document.getElementsByClassName("card"); // Obtém todos os elementos com a classe 'card'

  for (let i = 0; i < cards.length; i++) {
    let nomeProduto = cards[i].getElementsByClassName("card-nome")[0].innerText.toLowerCase();

    // Verifica se o nome do produto contém o valor de pesquisa
    if (nomeProduto.includes(input)) {
      cards[i].style.display = "block"; // Exibe o card
    } else {
      cards[i].style.display = "none"; // Oculta o card
    }
  }
}
