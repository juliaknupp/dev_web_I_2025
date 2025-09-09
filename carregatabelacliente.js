let clientes = {
    lista:[
        {nome: "Jose", id:2, nascimento: "Bom Jardim"},
        {nome: "Joao", id:3, nascimento: "Nova Friburgo"},
        {nome: "Julia", id:4, nascimento: "Cachoeiras de Macacu"},
    ]
}

document.addEventListener("DOMContentLoaded", (ev)=> {
ev.preventDefault();
let tabela = document.getElementsByTagName("table")[0];
clientes.lista.forEach(cliente => {
  let linha = document.createElement("tr");
  tabela.appendChild(linha);
  //NOME
  let colunaNome = document.createElement("td");
  linha.append(colunaNome);
  //NASCIMENTO
  let colunaNascimento = document.createElement("td");
  colunaNascimento.textContent = cliente.nascimento;
  linha.appendChild(colunaNascimento);


});
});
