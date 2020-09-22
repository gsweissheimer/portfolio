

        document.querySelector('body').classList.add('wall');

        var popup        = document.getElementById('popup');

        var ppAddressEl  = document.getElementById('popupAddress');

        var ppTimeEl     = document.getElementById('popupTime');

        var ppPhoneEl    = document.getElementById('popupPhone');

        var ppSiteEl     = document.getElementById('popupSite');

        var ppActionEl   = document.getElementById('popupButton');

        var ppMapsEl     = document.getElementById('popupMaps');

        document.getElementById('close_button').addEventListener('click', function(e) {

            e.preventDefault();

            popup.classList.add('invisible');

            setTimeout(() => {

                popup.classList.add('closed');

            }, 500);

        });

       /* document.getElementById('popupButton').addEventListener('click', function(e) {

            document.getElementById('close_button').click();

        });*/

        var _buttons = document.getElementById('portfolio').querySelectorAll('.action a');

        for(const button of _buttons) {

            button.addEventListener('click', function(e) {

                e.preventDefault();

                let ppAddress  = this.getAttribute('data-address');

                let ppTime     = this.getAttribute('data-time');

                let ppPhone    = this.getAttribute('data-phone');

                let ppSiteLink = this.getAttribute('data-siteLink');

                let ppSite     = this.getAttribute('data-site');

                let ppAction   = this.getAttribute('data-action');

                let ppMaps     = this.getAttribute('data-maps');

                ppAddressEl.innerHTML = ppAddress;

                ppTimeEl.innerHTML    = ppTime;

                ppPhoneEl.innerHTML   = ppPhone;

                ppSiteEl.innerHTML    = ppSite;

                ppSiteEl.href         = ppSiteLink;

                ppMapsEl.innerHTML    = ppMaps;

                popup.classList.remove('closed');

                setTimeout(() => {

                    popup.classList.remove('invisible');

                }, 500);

            });

        }
    

        if (window.innerWidth < 999) {    

            setTimeout(() => {

                var Headder = document.getElementById('header'); 

                var Offset = document.getElementById('offset'); 

                Headder.querySelector('.icon-bar .fa-bars').addEventListener('click', () => {

                    document.getElementById('primary-menu').classList.toggle('closed');

                });

                Offset.style.height = Headder.offsetHeight  + 'px';

            }, 500);

        }

 