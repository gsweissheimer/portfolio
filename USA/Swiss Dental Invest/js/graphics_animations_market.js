(function() {

    let defineLang = getCookie('lang');
    
    let scrollTop;

    let windowHeight = window.innerHeight;

    let graphicTop = document.querySelector('.graphic_trigger').offsetTop - windowHeight/1.333334;

    let chart = document.querySelector('.chartGif');

    let chartDiv = document.querySelector('.market_chart');

    let chartPng = document.querySelector('.chartPng');
    
    setTimeout(() => {

        chartDiv.style.height = chartPng.offsetHeight + 'px';

    }, 500)

    window.addEventListener('scroll', ev => {

        scrollTop = document.documentElement.scrollTop;

        if (scrollTop > graphicTop && !chart.classList.contains('animado')) animateGraph();

    })

    function animateGraph() {

        chart.src = '';

        chartPng.src = '';

        chart.classList.add('animado');

        setTimeout(() => {

            chart.src = 'img/graficos/' + defineLang + '/grafico_dados.png';

            chartPng.src = 'img/graficos/' + defineLang + '/grafico_dados.png';

            setTimeout(() => {

                chartPng.classList.add('showw');

                chart.classList.add('hiddde');

            }, 2000)

        }, 300)

    }

 })();