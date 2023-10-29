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
  