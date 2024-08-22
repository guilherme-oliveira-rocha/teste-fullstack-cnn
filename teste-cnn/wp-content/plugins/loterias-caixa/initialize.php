<?php
namespace GuilhermeRocha\LoteriasCaixa;

function initialize_loterias_caixa_plugin()
{
    if (class_exists('GuilhermeRocha\LoteriasCaixa\LoteriasCaixaPlugin')) {
        $plugin = new LoteriasCaixaPlugin();
        register_activation_hook(__FILE__, array($plugin, 'activate'));
        register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));
        add_shortcode('montaHtml', array($plugin, 'lcMontaHtml'));
    }
}
