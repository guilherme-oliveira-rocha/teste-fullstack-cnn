<?php

namespace GuilhermeRocha\LoteriasCaixa;

class HtmlGenerator
{
    public function generate($dados, $atts)
    {
        if (is_array($dados)) {
            $corPrimaria = $this->obterCorLoteria($atts['loteria']);
            $content = "
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f7f7f7;
                        margin: 0;
                        padding: 0;
                    }

                    .container {
                        max-width: 80%;
                        margin: 20px auto;
                        background-color: #fff;
                        border: 1px solid #ddd;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }

                    .header {
                        background-color: ".$corPrimaria.";
                        color: #fff;
                        padding: 15px;
                        text-align: center;
                        font-size: 18px;
                    }
                    
                    .header h1 {
                        font-size: 50px;
                    }

                    .numbers {
                        display: flex;
                        justify-content: space-around;
                        padding: 20px;
                        border-bottom: 1px solid #ddd;
                        flex-wrap: wrap;
                    }

                    .circle {
                        width: 50px;
                        height: 50px;
                        background-color: ".$corPrimaria.";
                        color: #fff;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 18px;
                        font-weight: bold;
                        padding: 14px;
                        margin: 8px 5px;
                    }

                    .prize {
                        text-align: center;
                        padding: 20px;
                        border-bottom: 1px solid #ddd;
                    }

                    .prize h2 {
                        font-size: 18px;
                        margin-bottom: 10px;
                    }

                    .prize p {
                        font-size: 24px;
                        font-weight: bold;
                        margin: 0;
                    }

                    .results {
                        padding: 20px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th, td {
                        text-align: center;
                        padding: 8px;
                        border-bottom: 1px solid #ddd;
                    }

                    th {
                        background-color: ".$corPrimaria.";
                        color: white;
                    }

                    tbody tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                </style>
                <div class='container'>
                    <div class='header'>
                        <h1>Concurso " . esc_html($dados["concurso"]) . " • 
                        " . esc_html($this->geraDiaDaSemana($dados["data"])) . " 
                        " . esc_html($dados["data"]) . "</h1>
                    </div>
                    <div class='numbers'>";
            
            foreach ($dados["dezenas"] as $numeros) {
                $content .= "<div class='circle'>" . esc_html($numeros) . "</div>";
            }

            $content .= "
                    </div>
                    <div class='prize'>
                        <h2>Premiação</h2>
                        <p>R$ " . esc_html(number_format($dados["valorArrecadado"], 2, ',', '.')) . "</p>
                    </div>
                    <div class='results'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Faixa</th>
                                    <th>Ganhadores</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>";

            foreach ($dados["premiacoes"] as $resultados) {
                $content .= "<tr>
                    <td>" . esc_html($resultados["faixa"]) . "</td>
                    <td>" . esc_html($resultados["ganhadores"]) . "</td>
                    <td>R$ " . esc_html(number_format($resultados["valorPremio"], 2, ',', '.')) . "</td>
                </tr>";
            }

            $content .= "
                            </tbody>
                        </table>
                    </div>
                </div>";
        } else {
            $content = "<div class='container'>
                <div class='header'>
                    <h1>Erro ao obter dados</h1>
                </div>
            </div>";
        }
        
        return $content;
    }

    private function obterCorLoteria($loteria)
    {
        $cores = array(
            'megasena'   => '#2D976A',
            'quina'      => '#261383',
            'lotofacil'  => '#921788',
            'lotomania'  => '#F58123',
            'timemania'  => '#3DAF3E',
            'duplasena'  => '#FF00FF',
            'federal'    => '#A41628',
            'diadesorte' => '#CA8536',
            'supersete'  => '#A9CF50'
        );

        return isset($cores[$loteria]) ? $cores[$loteria] : '#000';
    }

    private function geraDiaDaSemana($data)
    {
        $dataFormatada = \DateTime::createFromFormat('d/m/Y', $data);
        
        if ($dataFormatada === false) {
            return '';
        }
        $dataFormatada = $dataFormatada->format('Y-m-d');
        $timestamp = strtotime($dataFormatada);
        return date_i18n('l', $timestamp);
    }
}
