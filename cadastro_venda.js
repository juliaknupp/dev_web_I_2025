const botao = document.getElementById("add");
const display = document.querySelector("#display");

botao.addEventListener("click", function () {
    let produtoSelecionado = document.getElementById("produtos").value;
    let tabela = document.getElementById("selecao");

    let linhaEncontrada = null;
    if (tabela.rows.length > 0) {
        for (let i = 0; i < tabela.rows.length; i++) {
            let celula = tabela.rows[i].cells[0];
            if (celula.textContent === produtoSelecionado) {
                linhaEncontrada = tabela.rows[i];
                break;
            }
        }

        if (linhaEncontrada) {
            let celulaQtd = linhaEncontrada.cells[1];
            celulaQtd.textContent = parseInt(celulaQtd.textContent, 10) + 1;
        } 
        else {
            let novaLinha = tabela.insertRow();
            let celulaProduto = novaLinha.insertCell(0);
            let celulaQtd = novaLinha.insertCell(1);
            celulaProduto.textContent = produtoSelecionado;
            celulaQtd.textContent = 1;
        }
    } 
    else {
        let novaLinha = tabela.insertRow();
        let celulaProduto = novaLinha.insertCell(0);
        let celulaQtd = novaLinha.insertCell(1);
        celulaProduto.textContent = produtoSelecionado;
        celulaQtd.textContent = 1;
    }
});

document.addEventListener("DOMContentLoaded",
    (ev) => {
        let formCad = document.getElementById("formCadastroVenda");
        formCad.addEventListener("submit", (ev2) => {
            ev2.preventDefault();

            let tabela = document.getElementById("selecao");
            let produtosArr = [];
            let qtdArr = [];

            for (let i = 0; i < tabela.rows.length; i++) {
                let produto = tabela.rows[i].cells[0].textContent;
                let qtd = tabela.rows[i].cells[1].textContent;
                produtosArr.push(produto);
                qtdArr.push(qtd);
            }

            document.getElementById("produtos_hidden").value = produtosArr.join(",");
            document.getElementById("qtd").value = qtdArr.join(",");

            let campoCliente = document.getElementById("cliente");
            let campoFunc = document.getElementById("funcionario");
            let campoProdutos = document.getElementById("produtos_hidden");
            let campoQtd = document.getElementById("qtd");
            let campoData = document.getElementById("data");
            let campoPagamento = document.getElementById("paga");
            let campoDesconto = document.getElementById("desconto");
            validaFormulario(campoCliente.value, campoFunc.value, campoProdutos.value, campoQtd.value, campoData.value, campoPagamento.value, campoDesconto.value) ? formCad.submit() : null;
        });
    }
);
let validaFormulario = (cliente, func, produtos, qtd, data, paga, desc) => {
    return true;
};