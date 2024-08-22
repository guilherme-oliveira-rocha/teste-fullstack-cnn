<?php

namespace GuilhermeRocha\LoteriasCaixa;

class LoteriasService
{
    public function fetchFromApi($loteria, $concurso)
    {
        $loteria = strtolower(trim($loteria));
        $loteria = str_replace(' ', '', $loteria);

        $url = "https://loteriascaixa-api.herokuapp.com/api/{$loteria}/{$concurso}";

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            $errorMessage = $response->get_error_message();
            return "Erro na API: " . esc_html($errorMessage);
        }

        $dados = wp_remote_retrieve_body($response);
        $cacheKey = 'cacheLoteriasCaixaApi';
        set_transient($cacheKey, $dados, HOUR_IN_SECONDS);

        return $dados;
    }

    public function registerPostTypeLoteria($arrDadosEncode)
    {
        $arrDadosDecode = json_decode($arrDadosEncode, true);

        if ($arrDadosDecode === null) {
            return;
        }

        $args = array(
            'post_type'   => 'loterias',
            'author'      => $arrDadosDecode["concurso"],
            's'           => $arrDadosDecode["loteria"],
            'post_status' => 'publish',
        );

        $posts = get_posts($args);
        $cacheKey = 'cacheLoteriasCaixaPost';
        set_transient($cacheKey, $posts, HOUR_IN_SECONDS);

        if (!$posts) {
            global $wpdb;

            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO {$wpdb->posts} (post_author, post_content, post_title, post_status, 
                    comment_status, ping_status, post_type, comment_count)
                     VALUES (%d, %s, %s, %s, %s, %s, %s, %d)",
                    $arrDadosDecode["concurso"],
                    $arrDadosEncode,
                    $arrDadosDecode["loteria"] . " Concurso: " . $arrDadosDecode["concurso"],
                    'publish',
                    'open',
                    'open',
                    'loterias',
                    0
                )
            );
        }

        wp_reset_postdata();
    }

    public function verifyAndRegister($atts)
    {
        $atts['concurso'] = isset($atts['concurso']) && !empty($atts['concurso']) ? $atts['concurso'] : 'latest';

        if ($atts["concurso"] != "latest") {
            $args = array(
                'post_type'   => 'loterias',
                'author'      => $atts["concurso"],
                's'           => $atts["loteria"],
                'post_status' => 'publish',
            );

            $posts = get_posts($args);
            $cacheKey = 'cacheLoteriasCaixaPostRegister';
            set_transient($cacheKey, $posts, HOUR_IN_SECONDS);

            if ($posts) {
                $dadosReturnConsulta = $posts[0]->post_content;
                wp_reset_postdata();
            } else {
                $dadosReturnConsulta = $this->fetchFromApi($atts['loteria'], $atts['concurso']);
                $this->registerPostTypeLoteria($dadosReturnConsulta);
            }
        } else {
            $dadosReturnConsulta = $this->fetchFromApi($atts['loteria'], $atts['concurso']);
            $this->registerPostTypeLoteria($dadosReturnConsulta);
        }

        return json_decode($dadosReturnConsulta, true);
    }
}
