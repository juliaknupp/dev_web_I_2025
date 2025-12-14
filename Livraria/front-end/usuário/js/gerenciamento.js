const btnConsultarUsuarios = document.querySelector("#consultarUsuarios");
const btnListarTodosUsuarios = document.querySelector("#listarUsuarios");

function criarTabela(usuarios, div) {
  const tabela = document.createElement("table");
  const nomesColunas = document.createElement("tr");
  const nomeNome = document.createElement("th");
  nomeNome.textContent = "Nome";
  const nomeEmail = document.createElement("th");
  nomeEmail.textContent = "E-mail";
  const nomeSenha = document.createElement("th");
  nomeSenha.textContent = "Senha";
  nomesColunas.appendChild(nomeNome);
  nomesColunas.appendChild(nomeEmail);
  nomesColunas.appendChild(nomeSenha);
  tabela.appendChild(nomesColunas);
  usuarios.forEach((usuario) => {
    const linha = document.createElement("tr");
    const nome = document.createElement("td");
    nome.textContent = usuario.nome;
    linha.appendChild(nome);
    const email = document.createElement("td");
    email.textContent = usuario.email;
    linha.appendChild(email);
    const senha = document.createElement("td");
    senha.textContent = usuario.senha;
    linha.appendChild(senha);
    tabela.appendChild(linha);
  });
  div.appendChild(tabela);
}

function filtrarUsuarios(usuarios, filtro) {
  const usuariosFiltrados = usuarios.filter((usuario) => {
    return usuario.nome.includes(filtro) || usuario.email.includes(filtro);
  });
  return usuariosFiltrados;
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
async function consultarUsuarios() {
  const url = "http://localhost/livraria/back-end/index.php?modulo=usuário";
  const response = await fetch(url);
  const usuarios = await response.json();
  const div = document.querySelector("#saidaBusca");
  const filtro = document.querySelector("#busca").value;
  resetarDiv(div);
  criarTabela(filtrarUsuarios(usuarios, filtro), div);
}

/**
 * Função que deverá listar na tela todos os livros do acervo
 */
async function listarTodos() {
  const url = "http://localhost/livraria/back-end/index.php?modulo=usuário";
  const response = await fetch(url);
  const usuarios = await response.json();
  const div = document.querySelector("#saidaBusca");
  resetarDiv(div);
  criarTabela(usuarios, div);
}

btnConsultarUsuarios.addEventListener("click", consultarUsuarios);
btnListarTodosUsuarios.addEventListener("click", listarTodos);
