// require('./bootstrap');

// code for nav
document.body.addEventListener('click', function (e) {
    // var aux
    var isMenu = false;
    var isMenuFooter = false;

    // verifica se cliquei no menu ou no rodapé e coloque true em uma das var aux
    if(e.target.className == 'nav-link'){
        isMenu = true;
    }else if(e.target.className == 'text-reset'){
        isMenuFooter = true;
    }

    // pega a lista com os itens do menu e rodapé
    var itensm = document.querySelectorAll(".nav-item a");
    var itensmf = document.querySelectorAll(".menu-f p a");
    
    document.addEventListener("click", function(e) {
        // executa se cliquei em uma das
        if (isMenu || isMenuFooter) {
            // loop pelo menu
            for (let x = 0; x < itensm.length; x++) {
                // se cliquei no mesmo do menu add a classe, se nao remove qq outro
                if (e.target.getAttribute("data-id") == itensm[x].getAttribute("data-id") ){
                    itensm[x].classList.add("active")
                }else{
                    itensm[x].classList.remove("active")
                }
                // loop pelo menu rodape
                for (let y = 0; y < itensmf.length; y++) {
                    // se cliquei no mesmo do rodapé add a classe, se nao remove qq outro
                    if (e.target.getAttribute("data-id") == itensmf[y].getAttribute("data-id") ) {
                        itensmf[y].classList.add("active")
                    }
                    else{
                        itensmf[y].classList.remove("active")
                    }
                }
            }
        }
        // zera as var aux
        isMenu = false;
        isMenuFooter = false;
    })
}, false);