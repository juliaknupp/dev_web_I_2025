const btnConsultarLivros = document.querySelector("#consultarLivros");
const btnListarTodosLivros = document.querySelector("#listarLivros");

function criarPopup(livros, div) {
  let i = 1;
  const background = document.createElement("div");
  background.className = "backgroundPopup";
  livros.forEach((livro) => {
    const fechar = document.createElement("button");
    fechar.textContent = "Fechar";
    fechar.id = "fechar" + i;
    fechar.className = "fechar";
    fechar.addEventListener("click", fecharPopup);
    const popup = document.createElement("div");
    popup.id = "popup" + i;
    popup.className = "popup";
    const titulo = document.createElement("div");
    titulo.textContent = "Título: " + livro.titulo;
    const autor = document.createElement("div");
    autor.textContent = "Autor: " + livro.autor;
    const editora = document.createElement("div");
    editora.textContent = "Editora: " + livro.editora;
    const anoPublicacao = document.createElement("div");
    anoPublicacao.textContent = "Ano de publicação: " + livro.anoPublicacao;
    const genero = document.createElement("div");
    genero.textContent = "Gênero: " + livro.genero;
    const localizacao = document.createElement("div");
    localizacao.textContent = "Localização: " + livro.localizacao;
    const issn = document.createElement("div");
    issn.textContent = "ISSN: " + livro.ISSN;
    const disponibilidade = document.createElement("div");
    disponibilidade.textContent = "Disponível: " + livro.disponibilidade;
    popup.appendChild(titulo);
    popup.appendChild(autor);
    popup.appendChild(editora);
    popup.appendChild(anoPublicacao);
    popup.appendChild(genero);
    popup.appendChild(localizacao);
    popup.appendChild(issn);
    popup.appendChild(disponibilidade);
    popup.appendChild(fechar);
    background.appendChild(popup);
    i++;
  });
  div.appendChild(background);
}

function criarTabela(livros, div) {
  let i = 1;
  const tabela = document.createElement("table");
  const nomesColunas = document.createElement("tr");
  const nomeImagem = document.createElement("th");
  nomeImagem.textContent = "Imagem";
  const nomeLivro = document.createElement("th");
  nomeLivro.textContent = "Nome";
  const nomeAutor = document.createElement("th");
  nomeAutor.textContent = "Autor";
  const nomeBotao = document.createElement("th");
  nomeBotao.textContent = "Mais";
  nomesColunas.appendChild(nomeImagem);
  nomesColunas.appendChild(nomeLivro);
  nomesColunas.appendChild(nomeAutor);
  nomesColunas.appendChild(nomeBotao);
  tabela.appendChild(nomesColunas);
  livros.forEach((livro) => {
    const linha = document.createElement("tr");
    const titulo = document.createElement("td");
    titulo.textContent = livro.titulo;
    linha.appendChild(titulo);
    const autor = document.createElement("td");
    autor.textContent = livro.autor;
    linha.appendChild(autor);
    const botaoTd = document.createElement("td");
    const botao = document.createElement("button");
    botao.textContent = "Detalhes";
    botao.id = "botao" + i;
    botao.addEventListener("click", mostrarDetalhes);
    botaoTd.appendChild(botao);
    linha.appendChild(botaoTd);
    tabela.appendChild(linha);
    i++;
  });
  div.appendChild(tabela);
}

function filtrarLivros(livros, filtro) {
  const livrosFiltrados = livros.filter((livro) => {
    return (
      livro.autor.includes(filtro) ||
      livro.titulo.includes(filtro) ||
      livro.genero.includes(filtro)
    );
  });
  return livrosFiltrados;
}

function resetarDiv(div) {
  while (div.firstChild) {
    div.removeChild(div.firstChild);
  }
}

/**
 * Função que deverá pegar o parâmetro de filtro e listar todos os
 * exemplares que satisfizerem a condição
 */
async function consultarLivros() {
  const url = "http://localhost/livraria/back/index.php?modulo=livro";
  const response = await fetch(url);
  const livros = await response.json();
  const div = document.querySelector("#saidaBusca");
  const filtro = document.querySelector("#busca").value;
  resetarDiv(div);
  criarTabela(filtrarLivros(livros, filtro), div);
  criarPopup(filtrarLivros(livros, filtro), div);
}

/**
 * Função que deverá listar na tela todos os livros do acervo
 */
async function listarTodos() {
  const url = "http://localhost/livraria/back/index.php?modulo=livro";
  const response = await fetch(url);
  const livros = await response.json();
  const div = document.querySelector("#saidaBusca");
  resetarDiv(div);
  criarTabela(livros, div);
  criarPopup(livros, div);
}

function mostrarDetalhes() {
  document.querySelector(".backgroundPopup").style.display = "flex";
  document.querySelector("#popup" + this.id.slice(5)).style.display = "flex";
  document.querySelector("#popup" + this.id.slice(5)).style.flexDirection =
    "column";
}

function fecharPopup() {
  document.querySelector(".backgroundPopup").style.display = "none";
  document.querySelector("#popup" + this.id.slice(6)).style.display = "none";
}

btnConsultarLivros.addEventListener("click", consultarLivros);
btnListarTodosLivros.addEventListener("click", listarTodos);
