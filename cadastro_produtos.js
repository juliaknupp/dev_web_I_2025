document.addEventListener("DOMContentLoaded",
  (ev) => {
    let formCad = document.getElementById("formCadastroProduto");
    formCad.addEventListener("submit", (ev2) => {
      ev2.preventDefault();
      let campoNome = document.getElementById("nome");
      let campoPreco = document.getElementById("preco");
      validaFormulario(campoNome.value, campoPreco.value) ? formCad.submit() : null;
    });
  }
);
let validaFormulario = (nome, preco) => {
  return true;
};