<!--================6ta sesao=================-->
    <style>

        #sds-brans {
            width: 100%;
        }

        #sds-brans .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        #sds-brans .container a {
            display: contents;
        }

        #sds-brans .container .imgBox {
            background-color: #c0c0c0;/*#828282;*/
            text-align: center;
            border: 2px solid white;
            transition: all .2s;
            position: relative;
            cursor: pointer;
        }

        #sds-brans .container .imgBox.hOver,
        #sds-brans .container .imgBox:hover {
            background-color: #b21f24;
        }

        #sds-brans .container .imgBox img {
            width: 80%;
            opacity: .4;
            transition: all .2s;
        }

        #sds-brans .container .imgBox.hOver img,
        #sds-brans .container .imgBox:hover img {
            opacity: 1;
        }

        #sds-brans .container .imgBox > p {
            position: absolute;
            bottom: 20px;
            left: 10%;
            color: white;
            transform: translateY(10px);
            opacity: 0;
            text-decoration: underline;
            transition: all .3s;
        }

        #sds-brans .container .imgBox.hOver > p,
        #sds-brans .container .imgBox:hover > p {
            transform: translateY(0px);
            opacity: 1;
        }

        @media (max-width: 700px) {

            #sds-brans {
                padding: 20px;
            }

            #sds-brans .container .imgBox {
                width: calc(100% - 4px);
            }

        }

        @media (min-width: 701px) {

            #sds-brans {
                padding: 100px 0px;
            }

            #sds-brans .container .imgBox {
                width: calc(33.33333% - 4px);
            }

        }

    </style>
    <section id="sds-brans">
        <div class="container">
            <a href="https://swissdentalservices.com" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-01.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="http://swissdentalhealthplans.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-02.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://swissdentalconsulting.com//" target="blank">
                <div class="imgBox" data-hoverTwo="hOver" >
                    <img src="<?php base_url('logos-03.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://swissdentalinvest.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-04.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://oralswiss.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-05.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://www.swissdentaltrips.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-06.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://www.swissdentaleducation.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-07.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="#" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-08.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://meid-center.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-09.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://swissdentalceramic.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-10.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://swissdentalchannel.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-11.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>
            <a href="https://www.adip-us.com/" target="blank">
                <div class="imgBox" data-hoverTwo="hOver">
                    <img src="<?php base_url('logos-12.png','img/logs') ?>" alt="">
                    <p class="marging-cta-sds2">Conheça</p>
                </div>
            </a>




        </div>
    </section>

<!--================END 6ta sesao=============-->
