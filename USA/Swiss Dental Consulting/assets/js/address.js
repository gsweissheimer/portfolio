let countryButtons = document.querySelectorAll('.countryButton span');

var address;
var phone;
var email;

var addressEl = document.getElementById('addressEl');
var phoneEl = document.getElementById('phoneEl');
var emailEl = document.getElementById('emailEl');

var animationEl = document.querySelectorAll('.animationAddress');

var animationAddress = function() {

    [].forEach.call(animationEl,e=>{

        e.classList.add('faded');

        setTimeout(()=>{

            e.classList.remove('faded');

        },1000)

    })

};

var changeActive = function(e) {

    document.querySelector('.menu.active').classList.remove('active');

    e.classList.add('active');

};

[].forEach.call(countryButtons, function(e){

    e.addEventListener('click',ev => {

        changeActive(e);

        animationAddress();

        setTimeout(()=>{
        
            switch (e.getAttribute("data-country")) {

                case 'fr':

                    address = `242 Rue de Rivoli<br>PARIS, 75001 - FR`;
                    phone = `+33 1 7139 3361<br>+33 6 2058 7393`;
                    email = `infofr@swissdentalinvest.com`;
                    
                    break;

                case 'ma':

                    address = `200 S Biscayne Blvd, Suite 2790, Miami | FL 33131 - USA`;
                    phone = `+1 305 714 9500<br>+1 786 600 1565`;
                    email = `infous@swissdentalinvest.com`;
                    
                    break;

                case 'uk':

                    address = `201 Bessborough House / 28 Circus Road West, London, SW11 8EG - UK`;
                    phone = `+44 20 3239 6333<br>+ 44 7 73241 0807`;
                    email = `infouk@swissdentalinvest.com`;
                    
                    break;

                case 'sw':

                    address = `02 Carrefour de Rive, Geneva 03, GE 1211 - CH, Case Postale 3584`;
                    phone = `+41 22 575 4498<br>+41 76 243 0808`;
                    email = `infoch@swissdentalinvest.com`;
                    
                    break;
        
                default:

                    email = `infous@swissdentalinvest.com`;
                    phone = `+1 212 653 0700<br>+1 305 497 6666`;
                    address = `1330 Avenue of the Americas, Suite 23A, New York City | NY 10019 - USA`;

                    break;
            }

            addressEl.innerHTML = address;
            phoneEl.innerHTML = phone;
            emailEl.innerHTML = email;

        },600)
        

    })

})




