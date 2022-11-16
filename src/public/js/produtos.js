const obterProdutos = () => {
    
    const tbProdutos = document.getElementById('tb-produtos')
    
    let html = ""
    
    fetch('produtos.php')
    .then (resp => resp.json())
    .then ( resp => {
        console.log(resp.data)
        
        resp.data.forEach( (e) => {
            console.log(e)
            html += `<tr data-id="${e.id}" data-descricao="${e.descricao}" 
            data-ValorUnitario="${e.valor_unitario}">
            
            <td>${e.id}</td>
            <td>${e.descricao}</td>
            <td>${e.valor_unitario}</td>
            <td>
            <button type="button" onclick="popularFormProdutos(this);"   class="btn btn-info btn-sm">
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

const popularFormProdutos = (elem) => {
    // pega os dados do elemento pai
    const pd = elem.parentNode.parentNode
  
    // popula os inputs do formulário
    document.getElementById("id").value = pd.getAttribute('data-id')
    document.getElementById("descricao").value = pd.getAttribute('data-descricao')
    document.getElementById("ValorUnitario").value = pd.getAttribute('data-ValorUnitario')
}

const excluirProduto = (id) => {
    
    let formProdutos = new FormData();
    formProdutos.append('id', id);
    
    let salvar = undefined
    
    fetch(`produtos.php?id=${id}`, {
        mode: 'cors',
        method: 'DELETE',
     })
     .then(resp => resp.json())
     .then(resp => {console.log(resp); obterProdutos()})
     .catch(err => console.log(err))

     
     console.log('excluindo o registro...')
}

const salvarProduto = (e) => {

    const id =       document.getElementById('id').value;
    const descricao =     document.getElementById('descricao').value;
    const Valor_unitario =  document.getElementById('ValorUnitario').value;

    
    let formProdutos = new FormData();
    formProdutos.append('id', id);
    formProdutos.append('descricao',descricao);
    formProdutos.append('ValorUnitario', ValorUnitario)
    
    let salvar = undefined
    
    //console.log(formContato.toString())
    if ( id > 0 ){
        fetch('produtos.php', {
            mode: 'cors',
            method: 'PUT', 
            body: new URLSearchParams(formProdutos), 
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
            body: new URLSearchParams(formProdutos), 
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'} 
         })
         .then(resp => resp.json())
         .then(resp => {console.log(resp); obterProdutos()})
         .catch(err => console.log(err))

         
         console.log('incluindo novo...')
        }
        return false
    }



