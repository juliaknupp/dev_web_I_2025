const btnCadastrarUsuario = document.querySelector("#cadastrarUsuario");

/**
 * 
 * @param {*} nome
 * @param {*} email
 * @param {*} senha
 */
function Usuario(nome, email, senha) {
  this.nome = nome;
  this.email = email;
  this.senha = senha;
}

async function cadastrarUsuario() {
  const url = "http://localhost/livraria/back-end/index.php?modulo=usuário";

  const nome = document.querySelector("#novoNome").value;
  const email = document.querySelector("#novoEmail").value;
  const senha = document.querySelector("#novaSenha").value;

  const response = await fetch(url, {
    method: "POST",
    header: { "Content-Type": "application/json" },
    body: JSON.stringify(new Usuario(nome, email, senha)),
  });
}

btnCadastrarUsuario.addEventListener("click", cadastrarUsuario);
