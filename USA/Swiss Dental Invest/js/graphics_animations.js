(function() {

    let defineLang = getCookie('lang');

    let langTable = {
        "PT" : {
            "title_one":"INVESTIM.",
            "title_two":"ANOS",
            "title_three":"JUROS",
            "title_four":"CAPITAL",
            "title_five":"REEMBOLSO",
            "title_six":"JUROs",
            "title_seven":"PG. JUROS",
            "title_eight":"RESIDUAL",
            "title_nine":"TOTAL",
            "title_ten":"PG. MENSAL",
            "title_eleven": "Total de Juros",                
            "title_twelve": "Total Recebido"
        },
        "UK" : {
            "title_one":"INVESTMENT.",
            "title_two":"YEARS",
            "title_three":"INTEREST",
            "title_four":"INVESTMENT",
            "title_five":"REIMBURSEMENTS",
            "title_six":"INTEREST",
            "title_seven":"GP. RATES",
            "title_eight":"RESIDUAL",
            "title_nine":"TOTAL",
            "title_ten":"GP.MONTHLY L",
            "title_eleven": "Total Interest",                
            "title_twelve": "Total Received "
        },
        "FR" : {
            "title_one":"INVESTISSEMENT",
            "title_two":"ANS",
            "title_three":"INTÉRÊTS",
            "title_four":"CAPITAL",
            "title_five":"REMBOURSEMENT",
            "title_six":"INTÉRÊTS",
            "title_seven":"PAIEMENT D’ INTÉRÊTS",
            "title_eight":"RÉSIDUEL",
            "title_nine":"TOTAL",
            "title_ten":"PAIEMENT MENSUELL",
            "title_eleven": "Total des intérêts",                
            "title_twelve": "Total reçu"
        },
        "EN" : {
            "title_one":"INVESTIM.",
            "title_two":"YEARS",
            "title_three":"INTEREST",
            "title_four":"CAPITAL",
            "title_five":"RETURN",
            "title_six":"INTEREST",
            "title_seven":"INTEREST PAYMENT",
            "title_eight":"RESIDUAL",
            "title_nine":"TOTAL",
            "title_ten":"MONTHLY PAYMENTL",
            "title_eleven": "Total Interest",                
            "title_twelve": "Total Received "                    
        }
    };

    const values_one = [{
            'value' : '350.000,00',
            'gain' : '16%',
            'gift' : 'img/graficos/' + defineLang + '/grafic_animado_350k.gif',
            'png' : 'img/graficos/' + defineLang + '/grafic_animado_350k.png',
            'templateTable' : `
                    <tr>
                        <td><b>350.000,00</b></td>
                        <td>1</td>
                        <td>16%</td>
                        <td>350.000,00</td>
                        <td>0</td>
                        <td>56.000,00</td>
                        <td>56.000,00</td>
                        <td>350.000,00</td>
                        <td>56.000,00</td>
                        <td>4.666,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2</td>
                        <td>16%</td>
                        <td>350.000,00</td>
                        <td>87.500,00</td>
                        <td>56.000,00</td>
                        <td>56.000,00</td>
                        <td>262.500,00</td>
                        <td>143.500,00</td>
                        <td>11.958,33</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3</td>
                        <td>16%</td>
                        <td>262.500,00</td>
                        <td>87.500,00</td>
                        <td>42.000,00</td>
                        <td>42.000,00</td>
                        <td>175.000,00</td>
                        <td>129.500,00</td>
                        <td>10.791,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4</td>
                        <td>16%</td>
                        <td>175.000,00</td>
                        <td>87.500,00</td>
                        <td>28.000,00</td>
                        <td>28.000,00</td>
                        <td>87.500,00</td>
                        <td>115.500,00</td>
                        <td>9.625,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5</td>
                        <td>16%</td>
                        <td>87.500,00</td>
                        <td>87.500,00</td>
                        <td>14.000,00</td>
                        <td>14.000,00</td>
                        <td>0,00</td>
                        <td>101.500,00</td>
                        <td>8.458,33</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_eleven"] + `</td>
                        <td><b>196.000,00</b></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_twelve"] + `</b></td>
                        <td><b>546.000,00</b></td>
                        <td></td>
                    </tr>`,
            'templateTableMob' : `
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>1</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>16%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>350.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>56.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>56.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>350.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>56.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>4.666,67</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>2</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>16%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>350.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>56.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>56.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>262.500,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>143.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>11.958,33</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>3</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>16%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>262.500,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>42.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>42.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>175.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>129.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>10.791,67</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>4</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>16%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>175.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>28.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>28.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>115.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>9.625,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>5</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>16%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>87.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>14.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>14.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>0.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>101.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>8.458,33</td>
                    </tr>
                    <tr>
                        <td><b>Total de Juros</b></td>
                        <td><b>196.000,00</b></td>
                    </tr>
                    <tr>
                        <td><b>Total Recebido</b></td>
                        <td><b>546.000,00</b></td>
                    </tr>`
        },{
            'value' : '500.000,00',
            'gain' : '18%',
            'gift' : 'img/graficos/' + defineLang + '/grafic_animado_500k.gif',
            'png' : 'img/graficos/' + defineLang + '/grafic_animado_500k.png',
            'templateTable' : `
                    <tr>
                        <td><b>500.000,00</b></td>
                        <td>1</td>
                        <td>18%</td>
                        <td>500.000,00</td>
                        <td>0</td>
                        <td>90.000,00</td>
                        <td>90.000,00</td>
                        <td>500.000,00</td>
                        <td>90.000,00</td>
                        <td>7.500,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2</td>
                        <td>18%</td>
                        <td>500.000,00</td>
                        <td>125.000,00</td>
                        <td>90.000,00</td>
                        <td>90.000,00</td>
                        <td>375.000,00</td>
                        <td>215.000,00</td>
                        <td>17.916,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3</td>
                        <td>18%</td>
                        <td>375.000,00</td>
                        <td>125.000,00</td>
                        <td>67.500,00</td>
                        <td>67.500,00</td>
                        <td>250.000,00</td>
                        <td>192.500,00</td>
                        <td>16.041,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4</td>
                        <td>18%</td>
                        <td>250.000,00</td>
                        <td>125.000,00</td>
                        <td>45.000,00</td>
                        <td>45.000,00</td>
                        <td>125.000,00</td>
                        <td>170.000,00</td>
                        <td>14.166,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5</td>
                        <td>18%</td>
                        <td>125.000,00</td>
                        <td>125.000,00</td>
                        <td>22.500,00</td>
                        <td>22.500,00</td>
                        <td>0,00</td>
                        <td>147.500,00</td>
                        <td>12.291,67</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_eleven"] + `</td>
                        <td><b>315.000,00</b></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_twelve"] + `</b></td>
                        <td><b>815.000,00</b></td>
                        <td></td>
                    </tr>`,
            'templateTableMob' : `
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>1</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>18%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>500.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>90.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>90.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>500.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>90.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>7.500,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>2</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>18%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>500.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>90.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>90.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>375.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>215.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>17.916,67</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>3</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>18%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>375.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>67.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>67.500,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>250.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>192.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>16.041,67</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>4</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>18%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>250.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>45.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>45.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>170.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>14.166,67</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>5</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>18%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>125.000,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>22.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>22.500,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>0.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>147.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>12.291,67</td>
                    </tr>
                    <tr>
                        <td><b>Total de Juros</b></td>
                        <td><b>315.000,00</b></td>
                    </tr>
                    <tr>
                        <td><b>Total Recebido</b></td>
                        <td><b>815.000,00</b></td>
                    </tr>`
        },{
            'value' : '750.000,00',
            'gain' : '20%',
            'gift' : 'img/graficos/' + defineLang + '/grafic_animado_750k.gif',
            'png' : 'img/graficos/' + defineLang + '/grafic_animado_750k.png',
            'templateTable' : `
                    <tr>
                        <td><b>750.000,00</b></td>
                        <td>1</td>
                        <td>20%</td>
                        <td>750.000,00</td>
                        <td>0</td>
                        <td>150.000,00</td>
                        <td>150.000,00</td>
                        <td>750.000,00</td>
                        <td>150.000,00</td>
                        <td>12.500,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2</td>
                        <td>20%</td>
                        <td>750.000,00</td>
                        <td>187.500,00</td>
                        <td>150.000,00</td>
                        <td>150.000,00</td>
                        <td>562.500,00</td>
                        <td>337.500,00</td>
                        <td>28.125,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3</td>
                        <td>20%</td>
                        <td>562.500,00</td>
                        <td>187.500,00</td>
                        <td>112.500,00</td>
                        <td>112.500,00</td>
                        <td>375.000,00</td>
                        <td>300.000,00</td>
                        <td>25.000,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4</td>
                        <td>20%</td>
                        <td>375.000,00</td>
                        <td>187.500,00</td>
                        <td>75.000,00</td>
                        <td>75.000,00</td>
                        <td>187.500,00</td>
                        <td>262.500,00</td>
                        <td>21.875,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5</td>
                        <td>20%</td>
                        <td>187.500,00</td>
                        <td>187.500,00</td>
                        <td>37.500,00</td>
                        <td>37.500,00</td>
                        <td>0,00</td>
                        <td>225.000,00</td>
                        <td>18.750,00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_eleven"] + `</td>
                        <td><b>525.000,00</b></td>
                        <td></td>
                        <td><b>` + langTable[defineLang]["title_twelve"] + `</b></td>
                        <td><b>1.275.000,00</b></td>
                        <td></td>
                    </tr>`,
            'templateTableMob' : `
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>1</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>750.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>150.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>150.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>750.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>150.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>12.500,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>2</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>750.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>150.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>150.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>562.500,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>337.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>28.125,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>3</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>562.500,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>112.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>112.500,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>375.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>300.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>25.000,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>4</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>375.000,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>75.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>75.000,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>262.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>21.875,00</td>
                    </tr>
                    <tr class="head">
                        <td><b>Ano</b></td>
                        <td><b>5</b></td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>CAPITAL</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>REEMBOLSO</td>
                        <td>187.500,00</td>
                    </tr>
                    <tr>
                        <td>JUROS</td>
                        <td>37.500,00</td>
                    </tr>
                    <tr>
                        <td>PG. JUROS</td>
                        <td>37.500,00</td>
                    </tr>
                    <tr>
                        <td>RESIDUAL</td>
                        <td>0.000,00</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>225.000,00</td>
                    </tr>
                    <tr>
                        <td>PG. MENSAL</td>
                        <td>18.750,00</td>
                    </tr>
                    <tr>
                        <td><b>Total de Juros</b></td>
                        <td><b>525.000,00</b></td>
                    </tr>
                    <tr>
                        <td><b>Total Recebido</b></td>
                        <td><b>1.275.000,00</b></td>
                    </tr>`
        },{
            'value' : '1.000.000,00',
            'gain' : '22%',
            'gift' : 'img/graficos/' + defineLang + '/grafic_animado_1M.gif',
            'png' : 'img/graficos/' + defineLang + '/grafic_animado_1M.png',
            'templateTable' : `
                <tr>
                    <td><b>1.000.000,00</b></td>
                    <td>1</td>
                    <td>22%</td>
                    <td>1.000.000,00</td>
                    <td>0</td>
                    <td>220.000,00</td>
                    <td>220.000,00</td>
                    <td>1.000.000,00</td>
                    <td>220.000,00</td>
                    <td>18.333,33</td>
                </tr>
                <tr>
                    <td></td>
                    <td>2</td>
                    <td>22%</td>
                    <td>1.000.000,00</td>
                    <td>250.000,00</td>
                    <td>220.000,00</td>
                    <td>220.000,00</td>
                    <td>750.000,00</td>
                    <td>470.000,00</td>
                    <td>39.166,67</td>
                </tr>
                <tr>
                    <td></td>
                    <td>3</td>
                    <td>22%</td>
                    <td>750.000,00</td>
                    <td>250.000,00</td>
                    <td>165.000,00</td>
                    <td>165.000,00</td>
                    <td>500.000,00</td>
                    <td>415.000,00</td>
                    <td>34.583,33</td>
                </tr>
                <tr>
                    <td></td>
                    <td>4</td>
                    <td>22%</td>
                    <td>500.000,00</td>
                    <td>250.000,00</td>
                    <td>110.000,00</td>
                    <td>110.000,00</td>
                    <td>250.000,00</td>
                    <td>360.000,00</td>
                    <td>30.000,00</td>
                </tr>
                <tr>
                    <td></td>
                    <td>5</td>
                    <td>22%</td>
                    <td>250.000,00</td>
                    <td>250.000,00</td>
                    <td>55.000,00</td>
                    <td>55.000,00</td>
                    <td>0,00</td>
                    <td>305.000,00</td>
                    <td>25.416,67</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>` + langTable[defineLang]["title_eleven"] + `</td>
                    <td><b>770.000,00</b></td>
                    <td></td>
                    <td><b>` + langTable[defineLang]["title_twelve"] + `</b></td>
                    <td><b>1.770.000,00</b></td>
                    <td></td>
                </tr>`,
        'templateTableMob' : `
                <tr class="head">
                    <td><b>Ano</b></td>
                    <td><b>1</b></td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>22%</td>
                </tr>
                <tr>
                    <td>CAPITAL</td>
                    <td>1.000.000,00</td>
                </tr>
                <tr>
                    <td>REEMBOLSO</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>220.000,00</td>
                </tr>
                <tr>
                    <td>PG. JUROS</td>
                    <td>220.000,00</td>
                </tr>
                <tr>
                    <td>RESIDUAL</td>
                    <td>1.000.000,00</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>220.000,00</td>
                </tr>
                <tr>
                    <td>PG. MENSAL</td>
                    <td>18.333,33</td>
                </tr>
                <tr class="head">
                    <td><b>Ano</b></td>
                    <td><b>2</b></td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>22%</td>
                </tr>
                <tr>
                    <td>CAPITAL</td>
                    <td>1.000.000,00</td>
                </tr>
                <tr>
                    <td>REEMBOLSO</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>220.000,00</td>
                </tr>
                <tr>
                    <td>PG. JUROS</td>
                    <td>220.000,00</td>
                </tr>
                <tr>
                    <td>RESIDUAL</td>
                    <td>750.000,00</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>470.000,00</td>
                </tr>
                <tr>
                    <td>PG. MENSAL</td>
                    <td>39.166,67</td>
                </tr>
                <tr class="head">
                    <td><b>Ano</b></td>
                    <td><b>3</b></td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>22%</td>
                </tr>
                <tr>
                    <td>CAPITAL</td>
                    <td>750.000,00</td>
                </tr>
                <tr>
                    <td>REEMBOLSO</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>165.000,00</td>
                </tr>
                <tr>
                    <td>PG. JUROS</td>
                    <td>165.000,00</td>
                </tr>
                <tr>
                    <td>RESIDUAL</td>
                    <td>500.000,00</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>415.000,00</td>
                </tr>
                <tr>
                    <td>PG. MENSAL</td>
                    <td>34.583,33</td>
                </tr>
                <tr class="head">
                    <td><b>Ano</b></td>
                    <td><b>4</b></td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>22%</td>
                </tr>
                <tr>
                    <td>CAPITAL</td>
                    <td>500.000,00</td>
                </tr>
                <tr>
                    <td>REEMBOLSO</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>110.000,00</td>
                </tr>
                <tr>
                    <td>PG. JUROS</td>
                    <td>110.000,00</td>
                </tr>
                <tr>
                    <td>RESIDUAL</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>360.000,00</td>
                </tr>
                <tr>
                    <td>PG. MENSAL</td>
                    <td>30.000,00</td>
                </tr>
                <tr class="head">
                    <td><b>Ano</b></td>
                    <td><b>5</b></td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>22%</td>
                </tr>
                <tr>
                    <td>CAPITAL</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>REEMBOLSO</td>
                    <td>250.000,00</td>
                </tr>
                <tr>
                    <td>JUROS</td>
                    <td>55.000,00</td>
                </tr>
                <tr>
                    <td>PG. JUROS</td>
                    <td>55.000,00</td>
                </tr>
                <tr>
                    <td>RESIDUAL</td>
                    <td>0.000,00</td>
                </tr>
                <tr>
                    <td>TOTAL</td>
                    <td>305.000,00</td>
                </tr>
                <tr>
                    <td>PG. MENSAL</td>
                    <td>25.416,67</td>
                </tr>
                <tr>
                    <td><b>Total de Juros</b></td>
                    <td><b>770.000,00</b></td>
                </tr>
                <tr>
                    <td><b>Total Recebido</b></td>
                    <td><b>1.770.000,00</b></td>
                </tr>`
        }];

    let scrollTop;

    var index = 0;

    let windowHeight = window.innerHeight;

    let graphicTop = document.querySelector('.graphic_triger').offsetTop - windowHeight/1.7;

    let chart = document.querySelector('.chartEl');

    let changeButton = document.querySelector('h3.button');

    let selectBoxEl = document.querySelector('.hero .box');

    let tBody = document.querySelector('.desktop-only #tBody');
    let tBodyMob = document.querySelector('.mobileOnly #tBodyMob');

    let a350 = document.getElementById('350');

    let a500 = document.getElementById('500');

    let a750 = document.getElementById('750');

    let a1000 = document.getElementById('1000');

    let valueEl = document.getElementById('value');

    let gainEl = document.getElementById('gain');

    let chartDiv = document.querySelector('.chartDiv');

    let selectAmount = document.querySelectorAll('.selectAmount');

    let chartPng = document.querySelector('.chartPngEl');

    startChart(index);
    
    setTimeout(() => {

        chartDiv.style.height = chartPng.offsetHeight + 'px';

    }, 500)

    window.addEventListener('scroll', ev => {

        scrollTop = document.documentElement.scrollTop;

        if (scrollTop > graphicTop && !chart.classList.contains('animado')) animateGraph(index);

    })

    changeButton.addEventListener('click', ev => {

        ev.preventDefault;

        //nextAmount();

        openselect();

    })

    a350.addEventListener('click', ev => {

        ev.preventDefault;
        
        nextAmount2(0);

        openselect();

    })

    a500.addEventListener('click', ev => {

        ev.preventDefault;
        
        nextAmount2(1);

        openselect();

    })

    a750.addEventListener('click', ev => {

        ev.preventDefault;
        
        nextAmount2(2);

        openselect();

    })

    a1000.addEventListener('click', ev => {

        ev.preventDefault;
        
        nextAmount2(3);

        openselect();

    })

    function startChart(index) {

        chart.src = values_one[index].gift;

        chartPng.src = values_one[index].png;

        tBody.innerHTML = values_one[index].templateTable;

        tBodyMob.innerHTML = values_one[index].templateTableMob;

        valueEl.innerHTML = values_one[index].value;

        gainEl.innerHTML = values_one[index].gain;

    }

    function animateGraph(index) {

        let index_ = index;

        chart.src = '';

        chartPng.src = '';

        chart.classList.add('animado');

        setTimeout(() => {

            chart.src = values_one[index_].gift;

            chartPng.src = values_one[index_].png;

            setTimeout(() => {

                chartPng.classList.add('showw');

            }, 1800)

        }, 300)

    }

    function nextAmount() {

        chart.src = '';

        chartPng.src = '';

        chart.classList.remove('animado');

        chartPng.classList.remove('showw');

        setTimeout(() => {

            animateGraph();

            index++;

            switch (index) {
                case 1:
                    startChart(1);
                    break;
                case 2:
                    startChart(2);
                    break;
                case 3:
                    startChart(3);
                    break;
            
                default:
                    index = 0;
                    startChart(0);
                    break;
            }

        }, 500)

    }

    function nextAmount2(index) {

        let _index = index;

        toggleSelect(_index);

        chart.src = '';

        chartPng.src = '';

        chart.classList.remove('animado');

        chartPng.classList.remove('showw');

        setTimeout(() => {

            animateGraph(_index);

            switch (_index) {
                case 1:
                    startChart(1);
                    break;
                case 2:
                    startChart(2);
                    break;
                case 3:
                    startChart(3);
                    break;
            
                default:
                    startChart(0);
                    break;
            }

        }, 500)

    }

    function openselect() {

        selectBoxEl.classList.toggle('opened');

    }

    function toggleSelect(index) {

        [...selectAmount].forEach((e,i)=>{
            e.classList.remove('hidedd');
        })

        switch (index) {
            case 0:
                a350.classList.add('hidedd');
                break;
            case 1:
                a500.classList.add('hidedd');
                break;
            case 2:
                a750.classList.add('hidedd');
                break;
            case 3:
                a1000.classList.add('hidedd');
                break;
        }

    }

 })();