<?php
/*
Plugin Name: Loterias Caixa
Description: Plugin para o teste de dev full stack na CNN Brasil.
Version: 1.0.0
Author: Guilherme Rocha
Author URI: https://www.linkedin.com/in/guilhermeoliveirarocha/
License: GPL2
*/

namespace GuilhermeRocha\LoteriasCaixa;

require_once 'post-type-registrar.php';
require_once 'loterias-service.php';
require_once 'html-generator.php';
require_once 'initialize.php';

class LoteriasCaixaPlugin
{
    private $postTypeRegistrar;
    private $loteriasService;

    public function __construct()
    {
        $this->postTypeRegistrar = new PostTypeRegistrar();
        $this->loteriasService = new LoteriasService();
        $this->initialize();
    }

    public function activate()
    {
        $this->postTypeRegistrar->register();
    }

    public function deactivate()
    {
        $this->postTypeRegistrar->unregister();
    }

    public function lcMontaHtml($atts)
    {
        $dados = $this->loteriasService->verifyAndRegister($atts);
        $htmlGenerator = new HtmlGenerator();
        return $htmlGenerator->generate($dados, $atts);
    }

    private function initialize()
    {
        add_action('init', array($this->postTypeRegistrar, 'register'));
    }
}

// Evita a execução direta do arquivo
if (defined('ABSPATH')) {
    initialize_loterias_caixa_plugin();
}
