


var burguerButton = document.getElementById('burguer')
var headerEl = document.querySelector('header')

burguerButton.addEventListener('click', () => {

    if (!burguerButton.classList.contains('opened')){
        openMenu()
    } else {
        closeMenu()
    }

})

var url      = window.location.href; 
url          = url.split('/');
url          = url[url.length-1];

if(url == "fale-connosco" || url == "termos-condicoes"){

        headerEl.classList.add('fixed');

}else{


window.addEventListener('scroll', () => {  


    if (window.scrollY > 200) {

        headerEl.classList.add('fixed')

    } else {

        headerEl.classList.remove('fixed')

    }


})

}



function openMenu() {

    burguerButton.classList.add('opened')

    headerEl.classList.add('opened')

}

function closeMenu() {

    burguerButton.classList.remove('opened')

    headerEl.classList.remove('opened')

}