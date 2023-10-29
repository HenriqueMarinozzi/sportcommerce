window.onload = () => {
  carregarItensDoCarrinho(); // Chama a função para carregar os itens do carrinho
};

async function carregarItensDoCarrinho() {
  const resultado = await fetch("php/itens_carrinho.php", {
    method: "GET",
  });

  if (resultado.ok) {
    var dados = await resultado.json();
    const carrinhoConteudo = document.getElementById("carrinho-conteudo");

    carrinhoConteudo.innerHTML = ""; // Limpar o conteúdo anterior

    dados.forEach((item) => {
      var conteudo = `
        <div class="card">
          <div class="card-nome">${item.nome}</div>
          <div class="card-nome">${item.quantidade}</div>
          <div class="card-botao">
          <button class="botao-comprar" type="button" onclick="removerDoCarrinho(${item.id_carrinho})">Remover do Carrinho </button>
          </div>
        </div>
      `;

      carrinhoConteudo.innerHTML += conteudo;
    });
  } else {
    console.error("Erro na solicitação:", resultado.status);
  }
}

function removerDoCarrinho(idCarrinho) {
  var dados = new FormData();

  dados.append("id_carrinho", idCarrinho);

  fetch("php/removecarrinho.php", {
    method: "POST",
    body: dados,
  })
    .then(function (response) {
      if (response.ok) {
        // Se a resposta da requisição for bem-sucedida, recarregue a página
        location.reload();
      }
    })
    .catch(function (error) {
      console.error("Erro ao remover do carrinho:", error);
    });
}
