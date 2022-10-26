/**
 *
 * Carrega os dados que já estão visualizados na linha da tabela
 * e popula os dados dos elementos inputs do formulário
 * evitando assim que nova requisição seja enviada para o servidor
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 1.0
 *
 */

const popularFormProduto = (elem) => {
    // pega os dados do elemento pai
    const pdt = elem.parentNode.parentNode

    // popula os inputs do formulário
    document.getElementById("id").value = pdt.getAttribute('data-id')
    document.getElementById("produto").value = pdt.getAttribute('data-produto')
    document.getElementById("marca").value = pdt.getAttribute('data-marca')
    document.getElementById("unidade").value = pdt.getAttribute('data-unidade')
    document.getElementById("descricao").value = pdt.getAttribute('data-descricao')

    scrollTo(0,0)

}

const obterProdutos = () => {

    const tbProdutos = document.getElementById('tb-produtos')

    let html = ""

    fetch('produtos.php')
        .then (resp => resp.json())
        .then ( resp => {
            //const json = JSON.parse(resp)
            console.log(resp.data)

            resp.data.forEach( (e) => {
                console.log(e)
                html += `<tr data-id="${e.id}" data-produto="${e.produto}" 
                         data-marca="${e.marca}" data-unidade="${e.unidade}" 
                         data-descricao="${e.descricao}">

                        <td>${e.id}</td>
                        <td>${e.produto}</td> 
                        <td>${e.marca}</td>
                        <td>${e.unidade}</td> 
                        <td>${e.descricao}</td> 
                        
                        <td>
                           <button type="button" onclick="popularFormProduto(this);" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                           <button type="button" onclick="excluirProduto(${e.id})" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>`
            })
        })
        .finally( ()  =>  tbProdutos.innerHTML = html )
}


    const salvarProduto = (e) => {

        const id = document.getElementById('id').value;
        const produto = document.getElementById('produto').value;
        const marca =  document.getElementById('marca').value;
        const unidade =    document.getElementById('unidade').value;
        const descricao = document.getElementById('descricao').value;


    let formProduto = new FormData();
    formProduto.append('id', id);
    formProduto.append('produto',produto);
    formProduto.append('marca', marca)
    formProduto.append('unidade', unidade);
    formProduto.append('descricao', descricao);

    let salvar = undefined

    //console.log(formContato.toString())
    if ( id > 0 ){
        fetch('produtos.php', {
            mode: 'cors',
            method: 'PUT',
            body: new URLSearchParams(formProduto),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .then(resp => resp.json())
            .then(resp => { console.log(resp);obterProdutos() })
            .catch(err => console.log(err))

        console.log('atualizando...');

    } else {
        fetch('produtos.php', {
            mode: 'cors',
            method: 'POST',
            body: new URLSearchParams(formProduto),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .then(resp => resp.json())
            .then(resp => {console.log(resp); obterProdutos()})
            .catch(err => console.log(err))


        console.log('incluindo novo...')

    }
    return false;
}

    const excluirProduto = (id) => {

    let formProdutos = new FormData();
    formProdutos.append('id', id);

    let salvar = undefined

    fetch(`produtos.php?id=${id}`, {
        mode: 'cors',
        method: 'DELETE',
        //body: new URLSearchParams(formContato),
        //headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
    })
        .then(resp => resp.json())
        .then(resp => {console.log(resp); obterProdutos()})
        .catch(err => console.log(err))


    console.log('excluindo o registro...')
}

