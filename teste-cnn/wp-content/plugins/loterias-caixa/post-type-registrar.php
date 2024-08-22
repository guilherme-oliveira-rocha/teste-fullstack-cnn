<?php

namespace GuilhermeRocha\LoteriasCaixa;

class PostTypeRegistrar
{
    public function register()
    {
        $labels = array(
            'name'               => _x('Loterias', 'loterias', 'textDomain'),
            'singular_name'      => _x('Loteria', 'loterias', 'textDomain'),
            'menu_name'          => __('Loterias', 'textDomain'),
            'name_admin_bar'     => __('Loterias', 'textDomain'),
        );

        $args = array(
            'label'               => __('Loterias', 'textDomain'),
            'description'         => __('Descrição da Loteria', 'textDomain'),
            'labels'              => $labels,
            'supports'            => array('title', 'thumbnail', 'editor', 'author', 'excerpt', 'page-attributes'),
            'taxonomies'          => array('category', 'post_tag'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 2,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'menu_icon'           => 'dashicons-format-video',
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );

        register_post_type('loterias', $args);
    }

    public function unregister()
    {
        unregister_post_type('loterias');
    }
}
